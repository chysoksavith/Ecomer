@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="p-2">
                @include('_message')
            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $title }}</h3>
                            <a href="{{ route('admin.brands') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="brandForm" id="brandForm" method="post" enctype="multipart/form-data"
                            @if (empty($brand['id'])) action="{{ route('admin.add.edit.brand') }}"
                        @else
                            action="{{ route('admin.add.edit.brand', ['id' => $brand['id']]) }}" @endif>
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand_name">brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name"
                                        placeholder="Enter Page brand_name"
                                        @if (!empty($brand['brand_name'])) value="{{ $brand['brand_name'] }}"  @else value="{{ old('brand_name') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="brand_image">brand Image*</label>
                                    <input type="file" class="form-control" name="brand_image" id="brand_image">
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="col-md-3 ">
                                            @if (!empty($brand['brand_image']))
                                                <img src="{{ asset('front/images/brands/' . $brand['brand_image']) }}"
                                                    alt="sdf" class="img-fluid"> <br>
                                                <div class=" d-flex justify-content-center mt-2">
                                                    <a class="confirmDelete text-danger" name="brand"
                                                        title="Delete brand Image" href="javascript:void(0)"
                                                        record="brand-image" recordid="{{ $brand->id }}">
                                                        <i class="fas fa-trash"></i>Delete
                                                    </a>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="brand_logo">brand Logo*</label>
                                    <input type="file" class="form-control" name="brand_logo" id="brand_logo">
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="col-md-3 ">
                                            @if (!empty($brand['brand_logo']))
                                                <img src="{{ asset('front/images/brandsLogo/' . $brand['brand_logo']) }}"
                                                    alt="sdf" class="img-fluid"> <br>
                                                <div class=" d-flex justify-content-center mt-2">
                                                    <a class="confirmDelete text-danger" name="brand"
                                                        title="Delete brand Logo" href="javascript:void(0)"
                                                        record="brand-logo" recordid="{{ $brand->id }}">
                                                        <i class="fas fa-trash"></i>Delete
                                                    </a>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description">
                                        @if (!empty($brand['description']))
{{ $brand['description'] }}
@endif
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="brand_discount">brand_discount*</label>
                                    <input type="text" class="form-control" name="brand_discount"
                                        id="brand_discount" placeholder="Enter Page brand_discount"
                                        @if (!empty($brand['brand_discount'])) value="{{ $brand['brand_discount'] }}"  @else value="{{ old('brand_discount') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="url">Url*</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                        placeholder="Enter Page url"
                                        @if (!empty($brand['url'])) value="{{ $brand['url'] }}"  @else value="{{ old('url') }}" @endif>
                                </div>

                                {{-- ----------------------------Meta title----------------------------- --}}
                                <div class="form-group">
                                    <label for="meta_title">meta_title*</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Enter Page meta_title"
                                        @if (!empty($brand['meta_title'])) value="{{ $brand['meta_title'] }}"  @else value="{{ old('meta_title') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta_description *</label>
                                    <input type="text" class="form-control" name="meta_description" id="meta_description"
                                        placeholder="Enter Page meta_description"
                                        @if (!empty($brand['meta_description'])) value="{{ $brand['meta_description'] }}"  @else value="{{ old('meta_description') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="meta_Keywords">meta_keywords*</label>
                                    <input type="text" class="form-control" name="meta_Keywords" id="meta_Keywords"
                                        placeholder="Enter Page meta_Keywords"
                                        @if (!empty($brand['meta_Keywords'])) value="{{ $brand['meta_Keywords'] }}"  @else value="{{ old('meta_Keywords') }}" @endif>
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
