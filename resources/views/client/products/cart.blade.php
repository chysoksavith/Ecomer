
@extends('client.layouts.layout')
@section('content')
    <section class="CartMain" id="appendCartItems">
        @include('client.products.cart_item')
    </section>
@endsection
