@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>products</h1>
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
                                @if ($productsModule['edit_access'] == 1 || $productsModule['full_access'] == 1)
                                    <a href="{{ route('admin.add.edit.product') }}" class=" btn btn-primary">Create
                                        Products</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            <div class="p-2">
                                @include('_message')
                            </div>
                            <table id="productTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Create at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ optional($product)->id ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                @if (isset($product->images[0]))
                                                    <img src="{{ asset('front/images/products/' . $product->images[0]->image) }}"
                                                        width="60px">
                                                @else
                                                    <!-- Provide an alternate image or display a placeholder -->
                                                    <p>no image</p>
                                                @endif
                                            </td>

                                            <td>{{ optional($product)->product_name ?? 'N/A' }}</td>
                                            <td>{{ optional($product)->product_code ?? 'N/A' }}</td>
                                            <td>{{ optional($product)->product_color ?? 'N/A' }}</td>

                                            <td>
                                                @if (optional($product->created_at)->format('Y-m-d'))
                                                    {{ optional($product->created_at)->format('Y-m-d') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($productsModule['edit_access'] == 1 || $productsModule['full_access'] == 1)
                                                    <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                        product_id="{{ $product['id'] }}" href="javascript:void(0)">
                                                        @if ($product['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                @endif
                                            </td>
                                            <td class=" d-flex justify-content-around align-items-center">
                                                @if ($productsModule['edit_access'] == 1 || $productsModule['full_access'] == 1)
                                                    <a href="{{ url('admin/add-edit-product/' . $product->id) }}"><i
                                                            class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                @endif
                                                @if ($productsModule['full_access'] == 1)
                                                    <a class="confirmDelete" name="product" title="Delete product"
                                                        href="javascript:void(0)" record="product"
                                                        recordid="{{ $product->id }}"><i class="fas fa-trash"
                                                            style="font-size: red"></i></a>
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
