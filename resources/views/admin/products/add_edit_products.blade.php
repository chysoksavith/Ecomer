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
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sucess:</strong>{{ Session::get('success_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $title }}</h3>
                            <a href="{{ route('admin.products') }}" class="btn btn-warning ">Back</a>
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
                                            <option
                                                @if (!empty(old('category_id')) && $cat->id == old('category_id')) selected @elseif (!empty($product->category_id) && $product->category_id == $cat->id) selected @endif
                                                value="{{ $cat->id }}">⚫ {{ $cat->category_name }}</option>
                                            @foreach ($cat->subCategories as $subcat)
                                                <option
                                                    @if (!empty(old('category_id')) && $subcat->id == old('category_id')) selected @elseif (!empty($product->category_id) && $product->category_id == $subcat->id) selected @endif
                                                    value="{{ $subcat->id }}">⚪ ⚪ {{ $subcat->category_name }}</option>
                                                @foreach ($subcat->subCategories as $subsubcat)
                                                    <option
                                                        @if (!empty(old('category_id')) && $subsubcat->id == old('category_id')) selected @elseif (!empty($product->category_id) && $product->category_id == $subsubcat->id) selected @endif
                                                        value="{{ $subsubcat->id }}" class="red-text">⚪ ⚪ ⚪
                                                        {{ $subsubcat->category_name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                {{-- @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}"  @else value="{{ old('product_name') }}" @endif --}}
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Enter Product Name"
                                        @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="product_code">product Code</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code"
                                        placeholder="Enter Page product_code"
                                        @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="product_color">product color</label>
                                    <input type="text" class="form-control" id="product_color" name="product_color"
                                        placeholder="Enter Page product_color"
                                        @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                </div>
                                @php
                                    $familyColors = \App\Models\Color::colors();
                                @endphp
                                <div class="form-group">
                                    <label for="family_color">Family Color</label>
                                    <select class="form-select" name="family_color">
                                        <option value="">Select Main Colors</option>
                                        @foreach ($familyColors as $color)
                                            <option value="{{ $color['color_name'] }}"
                                                @if (old('family_color', $product->family_color) == $color['color_name'] ||
                                                        $product->family_color == $color['color_name']
                                                ) selected @endif>
                                                {{ $color['color_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="group_code">Group Code</label>
                                    <input type="text" class="form-control" id="group_code" name="group_code"
                                        placeholder="Enter Page group_code"
                                        @if (!empty($product['group_code'])) value="{{ $product['group_code'] }}" @else value="{{ old('group_code') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="product_price">product price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price"
                                        placeholder="Enter Page product_price"
                                        @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="product_discount">product discount(%)</label>
                                    <input type="text" class="form-control" id="product_discount" name="product_discount"
                                        placeholder="Enter Page product_discount"
                                        @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="product_weight">product weight</label>
                                    <input type="text" class="form-control" id="product_weight" name="product_weight"
                                        placeholder="Enter Page product_weight"
                                        @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="product_video">Product Video</label>
                                    <input type="file" class="form-control" id="product_video" name="product_video">

                                    @if (!empty($product['product_video']))
                                        <div class="mt-3">
                                            <label>Current Video:</label> <br>
                                            <video width="320" height="240" controls>
                                                <source src="{{ url('front/videos/' . $product['product_video']) }}"
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class="">
                                                <a href="{{ url('front/videos/' . $product['product_video']) }}"
                                                    target="_blank" class="btn btn-info">View Video</a>
                                                <a class="btn btn-danger confirmDelete" title="Delete Product Video"
                                                    href="javascrpt:void(0)" record="product-video"
                                                    recordid="{{ $product['id'] }}">Delete Video</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product_images">Product image</label>
                                    <input type="file" class="form-control" id="product_images"
                                        name="product_images[]" multiple>
                                    <label for="product_images" class="mt-3">Curretn image</label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @foreach ($product['images'] as $image)
                                            <div class="contra">
                                                <img class="img_pr"
                                                    src="{{ asset('front/images/products/' . $image['image']) }}"
                                                    alt="">
                                            </div>
                                            <input type="hidden" name="image[]" value="{{$image['image']}}">
                                            <input type="number" name="image_sort[]" value="{{$image['image_sort']}}" style="width: 30px">
                                            <div class="btndele">

                                                <a class="btn btn-danger confirmDelete" title="Delete Product images"
                                                    href="javascrpt:void(0)" record="product-image"
                                                    recordid="{{ $image['id'] }}">Delete image</a>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>


                                {{-- ----------------------------Product Filter ----------------------------- --}}
                                @include('admin.products.filter_product')
                                {{-- ----------------------------Text area----------------------------- --}}
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">
                                        @if (!empty($product['description']))
{{ $product['description'] }} @else{{ old('description') }}
@endif
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="wash_care">Wash Care</label>
                                    <textarea class="form-control" id="wash_care" name="wash_care" rows="3">
                                        @if (!empty($product['wash_care']))
{{ $product['wash_care'] }} @else{{ old('wash_care') }}
@endif
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Search_Keywords">Search Keywords</label>
                                    <textarea class="form-control" id="Search_Keywords" name="Search_Keywords" rows="3">
                                        @if (!empty($product['Search_Keywords']))
{{ $product['Search_Keywords'] }} @else{{ old('Search_Keywords') }}
@endif
                                    </textarea>
                                </div>
                                {{-- ----------------------------Meta title----------------------------- --}}
                                <div class="form-group">
                                    <label for="meta_title">meta_title*</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Enter Page meta_title"
                                        @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta_description *</label>
                                    <input type="text" class="form-control" name="meta_description"
                                        id="meta_description" placeholder="Enter Page meta_description"
                                        @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="meta_Keywords">meta_keywords*</label>
                                    <input type="text" class="form-control" name="meta_Keywords" id="meta_Keywords"
                                        placeholder="Enter Page meta_Keywords"
                                        @if (!empty($product['meta_Keywords'])) value="{{ $product['meta_Keywords'] }}" @else value="{{ old('meta_Keywords') }}" @endif>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Yes" name="is_featured"
                                        @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif>
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
