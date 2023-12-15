@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subadmin</h1>
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
                            <h4 class="card-title">{{ $title }}</h4>
                            <a href="{{ route('admin.subadmin') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="subAdminForm" id="subAdminForm" action="{{ route('admin-updateRoles', ['id' => $id]) }}"
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
                                {{-- <div class="form-group">
                                    <label for="email">Email</label>
                                    <input @if ($subadminData['id'] != '') disabled @else required @endif
                                        class="form-control" type="email" name="email" id="email"
                                        @if (!empty($subadminData['email'])) value="{{ $subadminData['email'] }}" @endif
                                        placeholder="Enter SubAdmin Email" style="background-color: #666666">
                                </div> --}}
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
                                        <strong>Success:</strong>{{ Session::get('success_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <input type="hidden" name="subadmin_id" value="{{ $id }}">
                                @if (!empty($subadminRoles))
                                    @foreach ($subadminRoles as $role)
                                        @if ($role['module'] == 'cms_pages')
                                            @if ($role['view_access'] == 1)
                                                @php
                                                    $viewCMSPages = 'checked';
                                                @endphp
                                            @else
                                                @php
                                                    $viewCMSPages = '';
                                                @endphp
                                            @endif
                                            {{-- edit --}}
                                            @if ($role['edit_access'] == 1)
                                                @php
                                                    $editCMSPages = 'checked';
                                                @endphp
                                            @else
                                                @php
                                                    $editCMSPages = '';
                                                @endphp
                                            @endif
                                            {{-- full --}}
                                            @if ($role['full_access'] == 1)
                                                @php
                                                    $fullCMSPages = 'checked';
                                                @endphp
                                            @else
                                                @php
                                                    $fullCMSPages = '';
                                                @endphp
                                            @endif
                                        @endif
                                        {{-- module category --}}
                                        @if ($role['module'] == 'categories')
                                            @if ($role['view_access'] == 1)
                                                @php
                                                    $viewCategories = 'checked';
                                                @endphp
                                            @else
                                                @php
                                                    $viewCategories = '';
                                                @endphp
                                            @endif
                                            {{-- edit --}}
                                            @if ($role['edit_access'] == 1)
                                                @php
                                                    $editCategories = 'checked';
                                                @endphp
                                            @else
                                                @php
                                                    $editCategories = '';
                                                @endphp
                                            @endif
                                            {{-- full --}}
                                            @if ($role['full_access'] == 1)
                                                @php
                                                    $fullCategories = 'checked';
                                                @endphp
                                            @else
                                                @php
                                                    $fullCategories = '';
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <label for="title">CMS Pages</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cms_pages[view]"
                                            value="1" @if (isset($viewCMSPages)) {{ $viewCMSPages }} @endif>
                                        <label class="form-check-label">View Access</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cms_pages[edit]"
                                            value="1" @if (isset($editCMSPages)) {{ $editCMSPages }} @endif>
                                        <label class="form-check-label">Edit Access</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cms_pages[full]"
                                            value="1" @if (isset($fullCMSPages)) {{ $fullCMSPages }} @endif>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                </div>
                                {{-- Module Category --}}
                                <div class="form-group">
                                    <label for="title">Category</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[view]"
                                            value="1" @if (isset($viewCategories)) {{ $viewCategories }} @endif>
                                        <label class="form-check-label">View Access</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[edit]"
                                            value="1" @if (isset($editCategories)) {{ $editCategories }} @endif>
                                        <label class="form-check-label">Edit Access</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[full]"
                                            value="1" @if (isset($fullCategories)) {{ $fullCategories }} @endif>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
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
