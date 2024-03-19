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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $title }}</h3>
                            <a href="{{ route('admin.banners') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="bannerForm" id="bannerForm" method="post" enctype="multipart/form-data"
                            @if (empty($banner['id'])) action="{{ route('admin.add.edit.banner') }}"
                        @else
                            action="{{ route('admin.add.edit.banner', ['id' => $banner['id']]) }}" @endif>
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <select name="type" class=" form-select">
                                        <option value="">Select</option>
                                        <option @if (!empty($banner['type']) && $banner['type'] == 'Slider') selected @endif value="Slider">Slider
                                        </option>
                                        <option @if (!empty($banner['type']) && $banner['type'] == 'Fix') selected @endif value="Fix">Fix
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">banner image*</label>1
                                    <input type="file" class="form-control" name="image" id="banner_image">
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="col-md-3">
                                            @if (!empty($banner->image))
                                                <img src="{{ asset('front/images/banner/' . $banner->image) }}"
                                                    alt="Banner Image" class="img-fluid">
                                                <br>
                                                <div class="d-flex justify-content-center mt-2">
                                                    <a class="confirmDelete text-danger" name="banner"
                                                        title="Delete banner Image" href="javascript:void(0)"
                                                        record="banner-image" recordid="{{ $banner->id }}">
                                                        <i class="fas fa-trash"></i>Delete
                                                    </a>
                                                </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">title*</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Enter Page title"
                                        @if (!empty($banner['title'])) value="{{ $banner['title'] }}"  @else value="{{ old('title') }}" @endif>
                                </div>

                                <div class="form-group">
                                    <label for="alt">alt*</label>
                                    <input type="text" class="form-control" name="alt" id="alt"
                                        placeholder="Enter Page alt"
                                        @if (!empty($banner['alt'])) value="{{ $banner['alt'] }}"  @else value="{{ old('alt') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="link">link*</label>
                                    <input type="text" class="form-control" name="link" id="link"
                                        placeholder="Enter Page link"
                                        @if (!empty($banner['link'])) value="{{ $banner['link'] }}"  @else value="{{ old('link') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="sort">sort*</label>
                                    <input type="text" class="form-control" name="sort" id="sort"
                                        placeholder="Enter Page sort"
                                        @if (!empty($banner['sort'])) value="{{ $banner['sort'] }}"  @else value="{{ old('sort') }}" @endif>
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
