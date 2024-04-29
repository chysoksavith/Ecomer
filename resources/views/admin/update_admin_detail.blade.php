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
                        <li class="breadcrumb-item active">Update Admin Detail</li>
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
                            <h3 class="card-title">Update Admin Detail</h3>
                        </div>
                        <div>
                            <div class="p-2">
                                @include('_message')
                            </div>


                        </div>

                        <form action="{{ route('admin.update.adminDetails') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="admin_email">Email address</label>
                                    <input class="form-control" id="admin_email"
                                        value="{{ Auth::guard('admin')->user()->email }}" readonly
                                        style="background-color: #666">
                                </div>
                                <div class="form-group">
                                    <label for="admin_name">Name</label>
                                    <input type="text" class="form-control" name="admin_name" id="admin_name"
                                        placeholder="name" value="{{ Auth::guard('admin')->user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" name="admin_mobile" id="admin_mobile"
                                        placeholder="mobile" value="{{ Auth::guard('admin')->user()->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="admin_image">Image</label>
                                    <input type="file" class="form-control" name="admin_image" id="admin_image">
                                </div>
                                <div class="from-group">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank"
                                            href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}">View
                                            Photo</a>
                                        <input type="hidden" name="current_image"
                                            value="{{ Auth::guard('admin')->user()->image }}">
                                    @endif
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
