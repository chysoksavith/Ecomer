@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Logo</h1>
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

                                <a href="{{ url('admin/logo-add') }}" class=" btn btn-primary">Create
                                    Logo</a>
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            <div class="p-2">
                                @include('_message')
                            </div>

                            <table id="logoTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $item)
                                        <tr class="align-items-center">
                                            <td class="text-center align-middle">{{ $item->id }}</td>
                                            <td class="text-center align-middle">
                                                <img src="{{ asset('admin/images/logo/' . $item->logo) }}" alt="Logo"
                                                    width="120px">
                                            </td>
                                            <td>
                                                <a class="updateLogoStatus" id="logo-{{ $item['id'] }}"
                                                    logo_id="{{ $item['id'] }}" href="javascript:void(0)">
                                                    @if ($item['status'] == 1)
                                                        <i class="fas fa-toggle-on" status="Active"></i>
                                                    @else
                                                        <i class="fas fa-toggle-off" style="color: grey"
                                                            status="Inactive"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class=" d-flex justify-content-around align-items-center">
                                                <a href="{{ url('admin/logo-edit/' . $item->id) }}"><i class="fas fa-edit"
                                                        style="font-size: #3fed3"></i></a>
                                                <a class="confirmDelete" name="logo" title="Delete Logo"
                                                    href="javascript:void(0)" record="logo"
                                                    recordid="{{ $item->id }}"><i class="fas fa-trash"
                                                        style="font-size: red"></i></a>
                                            </td>
                                        </tr>


                                    @endforeach
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
