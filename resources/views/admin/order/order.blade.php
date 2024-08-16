@extends('admin.layouts.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center p-3 mb-3"
                        style="background-color: #343a40;">
                        <h3>Orders</h3>
                        <div>
                            <a href="{{ url('admin/order') }}" class=" text-white mr-2">Data Refresh</a> <i
                                class="fa-solid fa-arrows-rotate"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-regular fa-square-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Orders Completed</span>
                                    <span class="info-box-number">{{ $orderCompleteCount }}</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fa-regular fa-square-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">New Orders</span>
                                    <span class="info-box-number">{{ $orderNewCount }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clock-rotate-left"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Orders Pending</span>
                                    <span class="info-box-number">{{ $orderPendingCount }}</span>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa-solid fa-ban"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Users Cancel</span>
                                    <span class="info-box-number">{{ $orderCancelCount }}</span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header ">
                            <div class="p-2">
                                @include('_message')
                            </div>

                            <table id="orderTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Order id</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Order Amount</th>
                                        <th>Delivery Fee</th>
                                        <th>Payment Method</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @csrf
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td> {{ $order['id'] }}
                                            </td>
                                            <td>{{ $order['user']['name'] }}</td>
                                            <td>{{ $order['mobile'] }}</td>

                                            <td>
                                                <span class="badge badge-success p-2 w-auto">
                                                    {{ $order['grand_total'] }} $
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success p-2 w-auto">
                                                    {{ $order['shipping_charges'] }} $
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success p-2 w-auto">
                                                    {{ $order['payment_method'] }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($order['order_status'] == 'New')
                                                    <span
                                                        class="badge badge-primary p-2 w-auto">{{ $order['order_status'] }}</span>
                                                @elseif ($order['order_status'] == 'Pending')
                                                    <span
                                                        class="badge badge-warning p-2 w-auto">{{ $order['order_status'] }}
                                                    </span>
                                                @elseif ($order['order_status'] == 'Cancelled')
                                                    <span
                                                        class="badge badge-danger p-2 w-auto">{{ $order['order_status'] }}
                                                    </span>
                                                @elseif (
                                                    $order['order_status'] == 'In Process' ||
                                                        $order['order_status'] == 'Shipped' ||
                                                        $order['order_status'] == 'Partially Shipped')
                                                    <span
                                                        class="badge badge-secondary p-2 w-auto">{{ $order['order_status'] }}
                                                    </span>
                                                @elseif (
                                                    $order['order_status'] == 'Delivered' ||
                                                        $order['order_status'] == 'Payment Captured' ||
                                                        $order['order_status'] == 'Payment Captured')
                                                    <span
                                                        class="badge badge-success p-2 w-auto">{{ $order['order_status'] }}
                                                    </span>
                                                @endif
                                            </td>
                                            @if ($ordersModule['edit_access'] == 1 || $ordersModule['full_access'] == 1)
                                                <td>
                                                    <ul class="navbar-nav ml-auto">
                                                        <li class="nav-item dropdown m-auto">
                                                            <a class="nav-link" data-toggle="dropdown" href="javascript:;">
                                                                <i class="fa-solid fa-ellipsis-vertical"
                                                                    style="font-size: 20px; color: white;"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                                                                <div class="dropdown-divider"></div>
                                                                <a href="{{ url('admin/orders/' . $order['id']) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fa-solid fa-pen-to-square  mr-2"></i>
                                                                    Edit Order Details
                                                                </a>
                                                                <div class="dropdown-divider"></div>

                                                                @if ($order['order_status'] == 'Shipped' || $order['order_status'] == 'Delivered')
                                                                    <a href="{{ url('admin/print-order-invoice/' . $order['id']) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-print mr-2"></i>
                                                                        Print Invoice Order
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                @else
                                                                    <span class="dropdown-item"> <i
                                                                            class="fas fa-print mr-2"></i> Print Invoice
                                                                        not
                                                                        available</span>
                                                                @endif
                                                                <div class="dropdown-divider"></div>
                                                                <a href="{{ url('admin/print-pdf-order-invoice/' . $order['id']) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-file-pdf mr-2"></i> Print Order
                                                                </a>

                                                            </div>
                                                        </li>
                                                    </ul>
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
    </div>
@endsection
