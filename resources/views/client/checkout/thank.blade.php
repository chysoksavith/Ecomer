@extends('client.layouts.layout')

@section('content')
    <div class="container_thanks">
        <div class="wrapper_thanks">
            <h4 class="h4_thanks">
                THANK YOU !
            </h4>
            <p class="p_thanks">
                Your Order Id ({{ Session::get('order_id') }}) and Grand Total is {{ Session::get('grand_total') }} $
            </p>
            <p class="p_thanks">Thank you for your order! We've received your request and are processing it with care. You'll
                receive a
                confirmation email shortly. If you have any questions or need assistance, please don't hesitate to contact
                our customer service team. We appreciate your business and look forward to serving you again!
            </p>
            <div class="btn_thanks">
                <a href="{{ url('/') }}" style="text-decoration: none">
                    <button type="submit" class="BtnApplyDiscount">Continue Shopping</button>
                </a>

            </div>
        </div>
    </div>
@endsection
