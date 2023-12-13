@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Add Sub Admin</h3>
                            <a href="{{ route('admin.subadmin') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="subAdminForm" id="subAdminForm" enctype="multipart/form-data"
                            @if (empty($subadminData['id'])) action="{{ route('admin-addedit-subadmin') }}"
                            @else
                        action="{{ route('admin-addedit-subadmin', ['id' => $subadminData['id']]) }}" @endif
                            method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error:</strong>{{ Session::get('error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter SubAdmin name"
                                        @if (!empty($subadminData['name'])) value="{{ $subadminData->name }}" @else value="{{ old('name') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="title">Mobile</label>
                                    <input type="number" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter SubAdmin Mobile"
                                        @if (!empty($subadminData['mobile'])) value="{{ $subadminData->mobile }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input @if ($subadminData['id'] != '') disabled @else required @endif
                                        class="form-control" type="email" name="email" id="email"
                                        @if (!empty($subadminData['email'])) value="{{ $subadminData['email'] }}" @endif
                                        placeholder="Enter SubAdmin Email" style="background-color: #666666">
                                </div>
                                <div class="form-group">
                                    <label for="title">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter SubAdmin password"
                                        @if (!empty($subadminData['password'])) value="{{ $subadminData->password }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="from-group">
                                    @if (!empty($subadminData['image']))
                                        <a target="_blank"
                                            href="{{ url('admin/images/photos/' . $subadminData['image']) }}">View
                                            Photo</a>
                                        <input type="hidden" name="current_image" value="{{ $subadminData['image'] }}">
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
