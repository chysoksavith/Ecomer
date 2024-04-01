@extends('client.layouts.layout')
@section('content')
    <div class="checkout-wrapper">
        <div class="checkout-header">
            <span class="checkout-title">
                Checkout with Paypal
            </span>
            <span class="checkout-description">
                Your order has been placed!
            </span>
        </div>
        <div class="checkout-header">
            <span class="checkout-description">
                Your order ID is <span class="bolds">{{ Session::get('order_id') }}</span>
                and Grand Total is <span class="bolds">{{ Session::get('grand_total') }} $ </span>
            </span> <br>
            <span class="checkout-description">
                Please make payment to confirm your order!
            </span>
        </div>
        <div class="checkout-header">
            <span class="checkout-title">
                <form action="{{ route('payment') }}" method="post">
                    @csrf
                    <input type="text" name="amount" value="{{ round(Session::get('grand_total') / 83, 2) }}">
                    <input type="image"
                        src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_l.png"
                        alt="pay with paypal">
                </form>

            </span>
        </div>

    </div>
@endsection
