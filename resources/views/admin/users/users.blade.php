@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <a href="">Categories Cms Pages</a>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" float-right">
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Sucess:</strong>{{ Session::get('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="" method="get">
                                @csrf
                                <div class="col-md-12">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div class=" card-title">
                                            {{-- <a href="{{ route('admin.users') }}" class="btn btn-sm btn-default">Reset</a> --}}
                                        </div>
                                        <div class="card-tools">
                                            <div class="input-group input-group" style="width: 250px;">
                                                <input value="{{ Request::get('Keyword') }}" type="text" name="Keyword"
                                                    class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table id="example" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>pincode</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Registerd on</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ optional($user)->id ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->name ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->address ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->city ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->state ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->country ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->pincode ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->mobile ?? 'N/A' }}</td>
                                                <td>{{ optional($user)->email ?? 'N/A' }}</td>
                                                <td>
                                                    @if (optional($user->created_at)->format('Y-m-d'))
                                                        {{ optional($user->created_at)->format('Y-m-d') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($usersModule['edit_access'] == 1 || $usersModule['full_access'] == 1)
                                                        <a class="updateuserstatus" id="user-{{ $user['id'] }}"
                                                            user_id="{{ $user['id'] }}" href="javascript:void(0)">
                                                            @if ($user['status'] == 1)
                                                                <i class="fas fa-toggle-on" status="Active"></i>
                                                            @else
                                                                <i class="fas fa-toggle-off" style="color: grey"
                                                                    status="Inactive"></i>
                                                            @endif
                                                        </a>
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
                            </form>
                        </div>
                        <!-- /.card-header -->
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
