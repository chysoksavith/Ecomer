@extends('admin.layouts.layout')
@section('content')
    @php
        use App\Models\Product;
    @endphp
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center justify-content-between">
                    <h1 class="m-0">Order Detail</h1>
                    <a target="_blank" class="btn btn-info" href="{{ url('admin/order') }}">Back</a>
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
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            {{-- order detail --}}
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Order Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Order ID</td>
                                                    <td>{{ $orderDetails['id'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Order Status</td>
                                                    <td>{{ $orderDetails['order_status'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Order Total</td>
                                                    <td>{{ $orderDetails['grand_total'] }} $</td>
                                                </tr>
                                                <tr>
                                                    <td>Shippin Charge</td>
                                                    <td>{{ $orderDetails['shipping_charges'] }} $</td>
                                                </tr>
                                                <tr>
                                                    <td>Couponn Code</td>
                                                    <td>{{ $orderDetails['coupon_code'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Coupon Amount</td>
                                                    <td>{{ $orderDetails['coupon_amount'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Method</td>
                                                    <td>{{ $orderDetails['payment_method'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Gateway</td>
                                                    <td>{{ $orderDetails['payment_gateway'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- user detail --}}
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Customer Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $orderDetails['user']['name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>{{ $orderDetails['user']['email'] }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- billing detail --}}
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Billing Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $orderDetails['user']['name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>{{ $orderDetails['user']['address'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{ $orderDetails['user']['city'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td>{{ $orderDetails['user']['state'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td>{{ $orderDetails['user']['country'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pincode</td>
                                                    <td>{{ $orderDetails['user']['pincode'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile</td>
                                                    <td>{{ $orderDetails['user']['mobile'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- delivery address --}}
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Delivery Address Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $orderDetails['user']['name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>{{ $orderDetails['user']['address'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{ $orderDetails['user']['city'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td>{{ $orderDetails['user']['state'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td>{{ $orderDetails['user']['country'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pincode</td>
                                                    <td>{{ $orderDetails['user']['pincode'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile</td>
                                                    <td>{{ $orderDetails['user']['mobile'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- row --}}
                        <div class="row">
                            {{-- order detail --}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Update Order Status</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <form action="{{ url('admin/update-order-status') }}" method="post">
                                                        <td colspan="2">
                                                            @csrf
                                                            <input type="hidden" name="order_id"
                                                                value="{{ $orderDetails['id'] }}">
                                                            <select name="order_status" class="form-select"
                                                                id="order_status">
                                                                <option selected>Selected</option>
                                                                @foreach ($orderStatues as $status)
                                                                    <option value="{{ $status['name'] }}">
                                                                        {{ $status['name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="courier_name" id="courier_name"
                                                                placeholder="courier name">
                                                            <input type="text" name="tracking_number"id="tracking_number"
                                                                placeholder="tracking number">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <td colspan="3">
                                                    <strong>
                                                        History Order log
                                                    </strong>
                                                </td>
                                                @foreach ($orderLog as $log)
                                                    <tr>
                                                        <td colspan="3">
                                                            <strong
                                                                class="badge badge-info">{{ $log['order_status'] }}</strong>
                                                            <br>
                                                            @if ($log['order_status'] == 'Shipped')
                                                                @if (!empty($orderDetails['courier_name']))
                                                                    Courier Name :
                                                                    <strong>{{ $orderDetails['courier_name'] }}</strong>
                                                                    <br>
                                                                @endif
                                                                @if (!empty($orderDetails['tracking_number']))
                                                                    Tracking Number :
                                                                    <strong>{{ $orderDetails['tracking_number'] }}</strong>
                                                                    <br>
                                                                @endif
                                                            @endif
                                                            @if ($log['reason'] != '')
                                                                <span>{{ $log['reason'] }}</span> <br>
                                                            @endif
                                                            {{ date('F j, Y, g:i a', strtotime($log['created_at'])) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Order Products</h3>
                                    </div>
                                    <!-- ./card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Product Image</th>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <th>Product Size</th>
                                                    <th>Product Color</th>
                                                    <th>Product Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderDetails['orders_products'] as $product)
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $getProductImage = Product::getProductImage(
                                                                    $product['product_id'],
                                                                );
                                                            @endphp
                                                            <a target="_blank"
                                                                href="{{ url('product/' . $product['product_id']) }}">
                                                                <img style="width: 80px; height: 80px;"
                                                                    src="{{ asset('front/images/products/' . $getProductImage) }}"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{ $product['product_code'] }}
                                                        </td>
                                                        <td>
                                                            {{ $product['product_name'] }}
                                                        </td>
                                                        <td>
                                                            {{ $product['product_size'] }}
                                                        </td>
                                                        <td>
                                                            {{ $product['product_color'] }}
                                                        </td>
                                                        <td>
                                                            {{ $product['product_qty'] }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
