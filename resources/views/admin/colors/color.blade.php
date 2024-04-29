@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Color</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" float-right">
                                @if ($colorsModule['edit_access'] == 1 || $colorsModule['full_access'] == 1)
                                    <a href="{{ route('add.edit.color') }}" class=" btn btn-primary">Create
                                        Color</a>
                                @endif

                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            <div class="p-2">
                                @include('_message')
                            </div>
                            <table id="ColorTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Url</th>
                                        <th>Create on</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($colors as $color)
                                        <tr>
                                            <td>{{ optional($color)->id ?? 'N/A' }}</td>
                                            <td>{{ optional($color)->color_name ?? 'N/A' }}</td>
                                            <td>{{ optional($color)->color_code ?? 'N/A' }} <span
                                                    style="background-color: {{ $color->color_code }}; display: inline-block; width: 20px; height: 20px;"></span>
                                            </td>

                                            <td>
                                                @if (optional($color->created_at)->format('Y-m-d'))
                                                    {{ optional($color->created_at)->format('Y-m-d') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            @if ($colorsModule['edit_access'] == 1 || $colorsModule['full_access'] == 1)
                                                <td>
                                                    <a class="updateColorStatus" id="color-{{ $color['id'] }}"
                                                        color_id="{{ $color['id'] }}" href="javascript:void(0)">
                                                        @if ($color['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                            @endif

                                            <td class=" d-flex justify-content-around align-items-center">
                                                @if ($colorsModule['edit_access'] == 1 || $colorsModule['full_access'] == 1)
                                                    <a href="{{ url('admin/add-edit-color/' . $color->id) }}"><i
                                                            class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                @endif
                                                @if ($colorsModule['full_access'] == 1)
                                                    <a class="confirmDelete" name="color" title="Delete color"
                                                        href="javascript:void(0)" record="color"
                                                        recordid="{{ $color->id }}"><i class="fas fa-trash"
                                                            style="font-size: red"></i></a>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No item record</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-header -->
                    </div>

                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
