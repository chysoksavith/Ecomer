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
                            <a href=""></a>
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
                            <table id="orderTable" class="table table-bordered table-hover">
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
                                            @if ($ordersModule['edit_access'] == 1 || $ordersModule['full_access'] == 1)
                                                <td>
                                                    <a href="{{ url('admin/orders/' . $order['id']) }}">
                                                        <i class="fas fa-file" style="font-size: 20px"></i>
                                                    </a>

                                                    &nbsp;&nbsp;
                                                    @if ($order['order_status'] == 'Shipped' || $order['order_status'] == 'Delivered')
                                                        <a target="_blank"
                                                            href="{{ url('admin/print-order-invoice/' . $order['id']) }}">
                                                            <i class="fas fa-print"style="font-size: 20px"></i>
                                                        </a>
                                                    @endif
                                                    &nbsp;&nbsp;
                                                    <a href="{{ url('admin/print-pdf-order-invoice/' . $order['id']) }}">
                                                        <i class="fas fa-file-pdf" style="font-size: 20px"></i>
                                                    </a>

                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
