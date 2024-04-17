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
            @if (!empty($_GET['order']) && $_GET['order'] == 'check')
                <p class="p_thanks">
                    Please send your check of amount USD {{ Session::get('grand_total') }} $ to below Address :
                <b> Sike@example.com </b><br>
                <b> PP, New Zeland</b> <br>
                <b> Cambodia </b><br>
                <b>Check Name </b>: sike.io
                </p>
            @endif
            @if (!empty($_GET['order']) && $_GET['order'] == 'bank')
                <p class="p_thanks">
                    Please send your Transfer amount USD {{ Session::get('grand_total') }} $ to below Bank Account :
                    <b> Account Holder Name</b> : Sike<br>
                    <b>Bank Name</b> : ABA<br>
                    <b>Code</b>: 12212212122112 <br>
                    <b> Check Name</b> : sike.io
                </p>
            @endif
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
