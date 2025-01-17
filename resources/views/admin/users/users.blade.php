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
                            <div class="p-2">
                                @include('_message')
                            </div>

                            <table id="userTable" class="table table-bordered table-hover">
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
                                    @foreach ($users as $user)
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
