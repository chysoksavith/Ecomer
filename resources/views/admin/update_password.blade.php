@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update Password</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Admin Password</h3>
                        </div>
                        <div>
                            <div class="p-2">
                                @include('_message')
                            </div>
                        </div>

                        <form action="{{ route('admin.update.password') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="admin_email">Email address</label>
                                    <input class="form-control" id="admin_email"
                                        value="{{ Auth::guard('admin')->user()->email }}" readonly
                                        style="background-color: #666">
                                </div>
                                <div class="form-group">
                                    <label for="current_password"> Current Password</label>
                                    <input type="password" class="form-control" name="current_password"
                                        id="current_password">
                                    <span id="verifyCurrentPwd"></span>
                                </div>
                                <div class="form-group">
                                    <label for="new_password"> New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confrim_password"> Confrim Password</label>
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confrim_password" placeholder="Password">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="sub" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
