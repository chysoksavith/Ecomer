@php
    use App\Models\Product;
    use App\Models\Orders;

    $getOrderStatus = Orders::getOrderStatus($orderDetails['id']);

@endphp
@extends('client.layouts.layout')
@section('content')
    <div class="containerAccount">
        <div class="leftContainAcc">
            <div class="leftAcc">
                @include('client.User.sidebarAccount')
            </div>
        </div>
        <div class="orderDetailContainer">
            <div class=" CancelOrder">
                <span class="notamember">
                    Order Details
                </span>
                @if ($getOrderStatus == 'New')
                    <span class="cancelBtn" id="openModalBtn">
                        Cancel Order
                    </span>
                @endif


            </div>
            <div class="orderDetailContainerBody">
                <div class="header_cartOrder bdnone">
                    <div class="txtHeader_cartOrder">
                        <span class="list_order">
                            Order #{{ $orderDetails['id'] }}
                        </span>
                        <span class="date_order">
                            Place on {{ \Carbon\Carbon::parse($orderDetails['created_at'])->format('h:i a d F Y') }}
                        </span>
                    </div>
                    <div class="viewDetail_cartOrder">
                        <span>Total: <span>{{ $orderDetails['grand_total'] }}$</span></span>
                    </div>
                </div>
            </div>

            {{-- packeg --}}
            @foreach ($orderDetails['orders_products'] as $Key => $items)
                <div class="orderDetailContainerBody">
                    <div class="header_cartOrder bdnone">
                        <span class="txt_orderdetak"><i class="fa-solid fa-cube icon-head"></i> Package
                            {{ $Key + 1 }}</span>
                    </div>
                    <div class="wrapper_iteminOrderdetail">
                        <span class="txt_orderdetak">Place on
                            {{ \Carbon\Carbon::parse($items['created_at'])->format('h:i a d F Y') }}</span>
                        <span class="txt_orderdetak">
                            <i class="fa-solid fa-van-shuttle icon-head"></i> Standard
                        </span>
                    </div>
                    {{-- progress bar --}}
                    <div id="bar-progress" class="mt-5 mt-lg-0">
                        <div class="step step-active">
                            <span class="number-container">
                                <span class="number">1</span>
                            </span>
                            <h5>Placed</h5>
                        </div>
                        <div class="seperator"></div>
                        <div class="step @if ($orderDetails['order_status'] == 'Shipped' || $orderDetails['order_status'] == 'Delivered') step-active @endif">
                            <span class="number-container">
                                <span class="number">2</span>
                            </span>
                            <h5>Shipped</h5>
                        </div>
                        <div class="seperator"></div>
                        <div class="step @if ($orderDetails['order_status'] == 'Delivered') step-active @endif">
                            <span class="number-container">
                                <span class="number">3</span>
                            </span>
                            <h5>Delivered</h5>
                        </div>
                    </div>


                    <div class="itemOrder_detail">
                        <div class="wrapper_imgDetail">
                            @php
                                $getProductImage = Product::getProductImage($items['product_id']);
                            @endphp
                            @if ($getProductImage != '')
                                <img src="{{ asset('front/images/products/' . $getProductImage) }}"
                                    alt="{{ $items['product_name'] }}" class="image_detail">
                            @else
                                <span>no images</span>
                            @endif

                            <div class="div_delailitems">
                                <span class="Name_itemDetaik">Product Name: <span class="quant">
                                        {{ $items['product_name'] }} </span> </span> <br>
                                <span class="Name_itemDetaik">Code: <span class="quant"> {{ $items['product_code'] }}
                                    </span> </span> <br>
                                <span class="Name_itemDetaik">Size: <span class="quant"> {{ $items['product_size'] }}
                                    </span> </span>

                            </div>

                        </div>
                        <div class="total_wrappDetail">
                            <span>Quantity : <span class="quant"> {{ $items['product_qty'] }} </span> </span>
                            <span class="db">Total : <span class="quant"> {{ $items['product_price'] }} </span>
                            </span>
                        </div>

                    </div>
                </div>
            @endforeach
            {{-- information --}}
            <div class="inforcontainer">
                <div class="information_wrap">
                    <div class="wrapper_leftInfo">
                        <div class="left_infor">
                            <ul class="textinfo">
                                <li class="litextinfo">
                                    <span class="infoSpan boldTextspan">
                                        Shipping address
                                    </span>
                                </li>
                                <li class="litextinfo">
                                    <span class="infoSpan">
                                        {{ $orderDetails['user']['name'] }}
                                    </span>
                                </li>
                                <li class="litextinfo">
                                    <span class="infoSpan">
                                        {{ $orderDetails['user']['address'] }},
                                        {{ $orderDetails['user']['city'] }},
                                        {{ $orderDetails['user']['state'] }},
                                        {{ $orderDetails['user']['pincode'] }},
                                        {{ $orderDetails['user']['country'] }}
                                    </span>
                                </li>
                                <li class="litextinfo">
                                    <span class="infoSpan">
                                        {{ $orderDetails['user']['mobile'] }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="left_infor topleft_info">
                            <ul class="textinfo">
                                <li class="litextinfo">
                                    <span class="infoSpan boldTextspan">
                                        Billing address
                                    </span>
                                </li>
                                <li class="litextinfo">
                                    <span class="infoSpan">
                                        {{ $orderDetails['user']['name'] }}
                                    </span>
                                </li>
                                <li class="litextinfo">
                                    <span class="infoSpan">
                                        {{ $orderDetails['user']['address'] }},
                                        {{ $orderDetails['user']['city'] }},
                                        {{ $orderDetails['user']['state'] }},
                                        {{ $orderDetails['user']['pincode'] }},
                                        {{ $orderDetails['user']['country'] }}
                                    </span>
                                </li>
                                <li class="litextinfo">
                                    <span class="infoSpan">
                                        {{ $orderDetails['user']['mobile'] }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="right_infor">
                        <ul class="textinfo">
                            <li class="litextinfo boldTextspan">
                                <span class="infoSpan">
                                    Total summary
                                </span>
                            </li>
                            <li class="litextinfo suprateDiv">
                                <span class="infoSpan">
                                    Sub Total:
                                </span>
                                <span class="infoSpan normalinforspan boldTextspan">
                                    {{ $orderDetails['grand_total'] }} $
                                </span>
                            </li>
                            <li class="litextinfo suprateDiv">
                                <span class="infoSpan">
                                    Shipping fee(+):
                                </span>
                                <span class="infoSpan normalinforspan boldTextspan">
                                    {{ $orderDetails['shipping_charges'] }} $
                                </span>
                            </li>
                            <li class="litextinfo suprateDiv">
                                <span class="infoSpan">
                                    tax(+):
                                </span>
                                <span class="infoSpan normalinforspan boldTextspan">
                                    10$
                                </span>
                            </li>
                            <li class="litextinfo suprateDiv">
                                <span class="infoSpan">
                                    Discount(-):
                                </span>
                                <span class="infoSpan normalinforspan boldTextspan">
                                    @if ($orderDetails['coupon_amount'] > 0)
                                        {{ $orderDetails['coupon_amount'] }}
                                    @else
                                        0
                                    @endif
                                </span>
                            </li>
                            <li class="litextinfo suprateDiv">
                                <span class="infoSpan">
                                    Grand Total:
                                </span>
                                <span class="infoSpan normalinforspan boldTextspan">
                                    {{ $orderDetails['grand_total'] }} $
                                </span>
                            </li>
                            <li class="litextinfo suprateDiv">
                                <span class="infoSpan">
                                    Paid by:
                                </span>
                                <span class="infoSpan normalinforspan boldTextspan">
                                    {{ $orderDetails['payment_method'] }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @if (!empty($orderDetails['log']))
                <div class="order_log">
                    <span class="notamember ">
                        Order Logs / Tracking Number
                    </span>

                </div>
                <div class="orderDetailContainerBody">
                    @foreach ($orderDetails['log'] as $log)
                        <div class="containSip">
                            <span class="orderStauts"> {{ $log['order_status'] }} </span>
                            @if ($log['order_status'] == 'Shipped')
                                @if (!empty($orderDetails['courier_name']))
                                    <span class="shipname">Courier Name:</span>
                                    <span class="namshio">{{ $orderDetails['courier_name'] }}</span>
                                @endif
                                @if (!empty($orderDetails['tracking_number']))
                                    <span class="tracking"></span>
                                    <span>Tracking Number:</span>
                                    <span class="namshio">{{ $orderDetails['tracking_number'] }}</span>
                                @endif
                            @endif
                            <span class="tracking"></span>
                            <span>
                                {{ date('F j, Y, g:i a', strtotime($log['created_at'])) }}
                            </span>
                        </div>
                    @endforeach

                </div>
            @endif

        </div>

    </div>
    @include('popup')

@endsection
