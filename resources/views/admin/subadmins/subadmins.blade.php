@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admins</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <a href="">Sub Admin</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title">Admin Table</h3>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin-addedit-subadmin') }}" class="btn btn-primary">Add Subadmin</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Created on</th>
                                        <th>Status</th>
                                        <th>Access</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subadmins as $subadmin)
                                        <tr>
                                            <td>{{ $subadmin->id ?? 'N/A' }}</td>
                                            <td>{{ $subadmin->name ?? 'N/A' }}</td>
                                            <td>{{ $subadmin->mobile ?? 'N/A' }}</td>
                                            <td>{{ $subadmin->email ?? 'N/A' }}</td>
                                            <td>{{ $subadmin->type ?? 'N/A' }}</td>
                                            <td>
                                                @if (!empty($subadmin->created_at))
                                                    {{ $subadmin->created_at->format('Y-m-d') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <a class="updateSubAdmin" id="subadmin-{{ $subadmin->id }}"
                                                    subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)">
                                                    @if ($subadmin['status'] == 1)
                                                        <i class="fas fa-toggle-on" status="Active"></i>
                                                    @else
                                                        <i class="fas fa-toggle-off" style="color: grey"
                                                            status="Inactive"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            {{-- access --}}
                                            <td>
                                                <a href="{{ url('admin/update-role/' . $subadmin->id) }}"><i
                                                        class="fas fa-unlock" style="font-size: #3fed3"></i></a>
                                            </td>
                                            {{-- action --}}
                                            <td class=" d-flex justify-content-around align-items-center">
                                                <a href="{{ url('admin/add-edit-subadmin/' . $subadmin->id) }}"><i
                                                        class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                {{-- delete --}}
                                                <a class="confirmDelete" name="subadmin" title="Delete SubAdmin"
                                                    href="javascript:void(0)" record="subadmin"
                                                    recordid="{{ $subadmin->id }}"><i class="fas fa-trash"
                                                        style="font-size: red"></i></a>
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
                        <!-- /.card-body -->
                        {{-- <div class="card-footer clearfix">

                        </div> --}}
                    </div>
                </div>

            </div><!-- /.container-fluid -->
    </section>
@endsection
