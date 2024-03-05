@extends('client.layouts.layout')
@section('content')
    <div class="containerAccount">
        <div class="leftContainAcc">
            <div class="leftAcc">
                @include('client.User.sidebarAccount')
            </div>
        </div>
        <div class="rightContainAcc">
            <div class="leftform">
                <span class="notamember">
                    My Orders
                </span>
                <span class="detailResetpASS">
                    Here you can see all products that have been delivered.
                </span>
            </div>
            {{-- body irem --}}
            @foreach ($orders as $order)
                <div class="cotnainer_cartOrder">
                    <div class="wrapper_carOrder">
                        <div class="header_cartOrder">
                            <div class="txtHeader_cartOrder">
                                <span class="list_order">
                                    Order # {{ $order->id }}
                                </span>
                                <span class="date_order">
                                   Place on {{ \Carbon\Carbon::parse($order['created_at'])->format('h:i a d F Y') }}
                                </span>
                            </div>
                            <div class="viewDetail_cartOrder">
                                <a href="" class="detail_cartOrder">
                                    View Details
                                </a>
                            </div>
                        </div>
                        {{-- grand total detail --}}
                        <div class="container_grandOrder">
                            <div class="wrapper_grandOrder">
                                <span class="bn16">{{ $order->order_status }}</span>

                            </div>
                            <div class="detail_grand">
                                <span class="grand_text">
                                    Payment Method: <span class="bold_grandtext">{{ $order->payment_method }}</span>
                                </span>
                                <span class="grand_text">
                                    Total Items : <span class="bold_grandtext">{{ count($order->orders_products) }}</span>
                                </span>
                                <span class="grand_text">
                                    Grand Total: <span class="bold_grandtext">{{ $order->grand_total }}$</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
