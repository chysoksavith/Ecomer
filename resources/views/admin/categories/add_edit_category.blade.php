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
                            <a href="{{ route('admin.categories') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data"
                            @if (empty($category['id'])) action="{{ route('admin.add.edit.category') }}"
                        @else
                            action="{{ route('admin.add.edit.category', ['id' => $category['id']]) }}" @endif>
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Category Name*</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name"
                                        placeholder="Enter Page category_name"
                                        @if (!empty($category['category_name'])) value="{{ $category['category_name'] }}"  @else value="{{ old('category_name') }}" @endif>
                                    <span style="color: red; font-size: 13px;">{{ $errors->first('category_name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="category_image">Category Level (Parent Category)</label>
                                    <select class="form-select" name="parent_id">
                                        <option value="">Select</option>
                                        <option value="0" @if ($category->parent_id == 0) selected @endif>Main
                                            Category</option>
                                        @foreach ($getCategories as $cat)
                                            <option @if ($category->parent_id == $cat->id) selected @endif
                                                value="{{ $cat->id }}">⚫ {{ $cat->category_name }}</option>
                                            @foreach ($cat->subCategories as $subcat)
                                                <option @if ($category->parent_id == $subcat->id) selected @endif
                                                    value="{{ $subcat->id }}">⚪⚪ {{ $subcat->category_name }}</option>
                                                @foreach ($subcat->subCategories as $subsubcat)
                                                    <option value="{{ $subsubcat->id }}"class="red-text">⚪ ⚪⚪
                                                        {{ $subsubcat->category_name }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="category_image">Category Image</label>
                                    <input type="file" class="form-control" name="category_image" id="category_image">
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="col-md-3 ">
                                            @if (!empty($category['category_image']))
                                                <img src="{{ asset('admin/images/category/' . $category['category_image']) }}"
                                                    alt="sdf" class="img-fluid"> <br>
                                                <div class=" d-flex justify-content-center mt-2">
                                                    <a class="confirmDelete text-danger" name="category"
                                                        title="Delete category Image" href="javascript:void(0)"
                                                        record="category-image" recordid="{{ $category->id }}">
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
                                        @if (!empty($category['description']))
{{ $category['description'] }}
@else
{{ old('description') }}
@endif
                                    </textarea>

                                </div>

                                <div class="form-group">
                                    <label for="category_discount">Category discount</label>
                                    <input type="text" class="form-control" name="category_discount"
                                        id="category_discount" placeholder="Enter Page category discount"
                                        @if (!empty($category['category_discount'])) value="{{ $category['category_discount'] }}"  @else value="{{ old('category_discount') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="url">Url*</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                        placeholder="Enter Page url"
                                        @if (!empty($category['url'])) value="{{ $category['url'] }}"  @else value="{{ old('url') }}" @endif>
                                    <span style="color: red; font-size: 13px;">{{ $errors->first('url') }}</span>
                                </div>

                                {{-- ----------------------------Meta title----------------------------- --}}
                                <div class="form-group">
                                    <label for="meta_title">meta title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Enter Page meta title"
                                        @if (!empty($category['meta_title'])) value="{{ $category['meta_title'] }}"  @else value="{{ old('meta_title') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta description </label>
                                    <input type="text" class="form-control" name="meta_description" id="meta_description"
                                        placeholder="Enter Page meta description"
                                        @if (!empty($category['meta_description'])) value="{{ $category['meta_description'] }}"  @else value="{{ old('meta_description') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="meta_Keywords">meta keywords</label>
                                    <input type="text" class="form-control" name="meta_Keywords" id="meta_Keywords"
                                        placeholder="Enter Page meta Keywords"
                                        @if (!empty($category['meta_Keywords'])) value="{{ $category['meta_Keywords'] }}"  @else value="{{ old('meta_Keywords') }}" @endif>
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
