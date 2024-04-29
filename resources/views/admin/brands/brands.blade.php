@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brands</h1>
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
                                @if ($brandsModule['edit_access'] == 1 || $brandsModule['full_access'] == 1)
                                    <a href="{{ route('admin.add.edit.brand') }}" class=" btn btn-primary">Create
                                        Brands</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            <div class="p-2">
                                @include('_message')
                            </div>

                            <table id="brandTable" class="table table-bordered table-hover">
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
                                    @forelse ($brands as $brand)
                                        <tr>
                                            <td>{{ optional($brand)->id ?? 'N/A' }}</td>
                                            <td>{{ optional($brand)->brand_name ?? 'N/A' }}</td>
                                            <td>{{ optional($brand)->url ?? 'N/A' }}</td>
                                            <td>
                                                @if (optional($brand->created_at)->format('Y-m-d'))
                                                    {{ optional($brand->created_at)->format('Y-m-d') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($brandsModule['edit_access'] == 1 || $brandsModule['full_access'] == 1)
                                                    <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}"
                                                        brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                                                        @if ($brand['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                @endif
                                            </td>
                                            <td class=" d-flex justify-content-around align-items-center">
                                                @if ($brandsModule['edit_access'] == 1 || $brandsModule['full_access'] == 1)
                                                    <a href="{{ url('admin/add-edit-brand/' . $brand->id) }}"><i
                                                            class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                @endif
                                                @if ($brandsModule['full_access'] == 1)
                                                    <a class="confirmDelete" name="brand" title="Delete brand"
                                                        href="javascript:void(0)" record="brand"
                                                        recordid="{{ $brand->id }}"><i class="fas fa-trash"
                                                            style="font-size: red"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- href="{{ url('admin/delete-cms-pages/' . $page->id) }}" --}}
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
