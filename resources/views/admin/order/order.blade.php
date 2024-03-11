@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ratings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <a href="">Categories Cms Pages</a>
                        </li>
                    </ol>
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
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="" method="get">
                                @csrf
                                <div class="col-md-12">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div class=" card-title">
                                            {{-- <a href="{{ route('admin.ratings') }}" class="btn btn-sm btn-default">Reset</a> --}}
                                        </div>
                                        <div class="card-tools">
                                            <div class="input-group input-group" style="width: 250px;">
                                                <input value="{{ Request::get('Keyword') }}" type="text" name="Keyword"
                                                    class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table id="example" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Order Date</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Customer Produt</th>
                                            <th>Order Amount</th>
                                            <th>Order Status</th>
                                            <th>Payment Method</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order['id'] }}</td>
                                                <td>{{ date('F j, Y, g:i a', strtotime($order['created_at'])) }}</td>
                                                <td>{{ $order['user']['name'] }}</td>
                                                <td>{{ $order['user']['email'] }}</td>
                                                <td>
                                                    @foreach ($order['orders_products'] as $product)
                                                        <span class="badge badge-info"> Code</span> :
                                                        {{ $product['product_code'] }}
                                                        <span class="badge badge-info"> Qty</span> :
                                                        ({{ $product['product_qty'] }})
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $order['grand_total'] }} $
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">{{ $order['order_status'] }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $order['payment_method'] }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/orders/' . $order['id']) }}">
                                                        <i class="fas fa-file"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- /.card-header -->
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
