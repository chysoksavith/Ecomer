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
                            <a href="{{ route('admin.categories') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="productForm" id="productForm" method="post" enctype="multipart/form-data"
                            @if (empty($product['id'])) action="{{ route('admin.add.edit.product') }}"
                        @else
                            action="{{ route('admin.add.edit.product', ['id' => $product['id']]) }}" @endif>
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Select Cateegory</label>
                                    <select class="form-select" name="category_id">
                                        <option value="">Select</option>
                                        @foreach ($getCategories as $cat)
                                            <option value="{{ $cat->id }}">⚫ {{ $cat->category_name }}</option>
                                            @foreach ($cat->subCategories as $subcat)
                                                <option value="{{ $subcat->id }}">⚪ ⚪ {{ $subcat->category_name }}
                                                </option>
                                                @foreach ($subcat->subCategories as $subsubcat)
                                                    <option value="{{ $subsubcat->id }}" class="red-text">⚪ ⚪ ⚪
                                                        {{ $subsubcat->category_name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                {{-- @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}"  @else value="{{ old('product_name') }}" @endif --}}
                                <div class="form-group">
                                    <label for="product_name">product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Enter Page product_name">
                                </div>
                                <div class="form-group">
                                    <label for="product_code">product Code</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code"
                                        placeholder="Enter Page product_code">
                                </div>
                                <div class="form-group">
                                    <label for="product_color">product color</label>
                                    <input type="text" class="form-control" id="product_color" name="product_color"
                                        placeholder="Enter Page product_color">
                                </div>
                                <div class="form-group">
                                    <label for="family_color">Family Color</label>
                                    <select class="form-select" name="family_color">
                                        <option value="Red">Select Main Color</option>
                                        <option value="Green">Green</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Orange">Orange</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="group_code">Group Code</label>
                                    <input type="text" class="form-control" id="group_code" name="group_code"
                                        placeholder="Enter Page group_code">
                                </div>
                                <div class="form-group">
                                    <label for="product_price">product price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price"
                                        placeholder="Enter Page product_price">
                                </div>
                                <div class="form-group">
                                    <label for="product_discount">product discount(%)</label>
                                    <input type="text" class="form-control" id="product_discount" name="product_discount"
                                        placeholder="Enter Page product_discount">
                                </div>
                                <div class="form-group">
                                    <label for="product_weight">product weight</label>
                                    <input type="text" class="form-control" id="product_weight" name="product_weight"
                                        placeholder="Enter Page product_weight">
                                </div>
                                <div class="form-group">
                                    <label for="product_video">product video</label>
                                    <input type="file" class="form-control" id="product_video" name="product_video">
                                </div>
                                {{-- ----------------------------Product Filter ----------------------------- --}}
                                @include('admin.products.filter_product')
                                {{-- ----------------------------Text area----------------------------- --}}
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="wash_care">Wash Care</label>
                                    <textarea class="form-control" id="wash_care" name="wash_care" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Search_Keywords">Search Keywords</label>
                                    <textarea class="form-control" id="Search_Keywords" name="Search_Keywords" rows="3"></textarea>
                                </div>
                                {{-- ----------------------------Meta title----------------------------- --}}
                                <div class="form-group">
                                    <label for="meta_title">meta_title*</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Enter Page meta_title">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta_description *</label>
                                    <input type="text" class="form-control" name="meta_description"
                                        id="meta_description" placeholder="Enter Page meta_description">
                                </div>
                                <div class="form-group">
                                    <label for="meta_Keywords">meta_keywords*</label>
                                    <input type="text" class="form-control" name="meta_Keywords" id="meta_Keywords"
                                        placeholder="Enter Page meta_Keywords">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Yes" name="is_featured">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        is_featured
                                    </label>
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
