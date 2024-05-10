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
                            <div class="p-2">
                                @include('_message')
                            </div>
                            <table id="orderTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Order id</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Order Amount</th>
                                        <th>Order Status</th>
                                        <th>Edit</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order['id'] }}</td>
                                            <td>{{ $order['user']['name'] }}</td>
                                            <td>{{ $order['user']['email'] }}</td>

                                            <td>
                                                {{ $order['grand_total'] }} $
                                            </td>
                                            <td class="text-center">
                                                @if ($order['order_status'] == 'New')
                                                    <span
                                                        class="badge badge-primary p-2 w-50">{{ $order['order_status'] }}</span>
                                                @elseif ($order['order_status'] == 'Pending')
                                                    <span class="badge badge-warning p-2 w-50">{{ $order['order_status'] }}
                                                    </span>
                                                @elseif (
                                                    $order['order_status'] == 'In Process' ||
                                                        $order['order_status'] == 'Shipped' ||
                                                        $order['order_status'] == 'Partially Shipped')
                                                    <span
                                                        class="badge badge-secondary p-2 w-50">{{ $order['order_status'] }}
                                                    </span>
                                                @elseif (
                                                    $order['order_status'] == 'Delivered' ||
                                                        $order['order_status'] == 'Payment Captured' ||
                                                        $order['order_status'] == 'Payment Captured')
                                                    <span class="badge badge-success p-2 w-50">{{ $order['order_status'] }}
                                                    </span>
                                                @endif
                                            </td>

                                            @if ($ordersModule['edit_access'] == 1 || $ordersModule['full_access'] == 1)
                                                <td class="text-center">
                                                    <a href="{{ url('admin/orders/' . $order['id']) }}">
                                                        <i class="fa-solid fa-pen-to-square"style="font-size: 20px"></i>
                                                    </a>

                                                </td>
                                            @endif
                                            @if ($ordersModule['edit_access'] == 1 || $ordersModule['full_access'] == 1)
                                                <td class=" d-flex justify-content-evenly">

                                                    @if ($order['order_status'] == 'Shipped' || $order['order_status'] == 'Delivered')
                                                        <a target="_blank"
                                                            href="{{ url('admin/print-order-invoice/' . $order['id']) }}">
                                                            <i class="fas fa-print"style="font-size: 20px"></i>
                                                        </a>
                                                    @endif
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
