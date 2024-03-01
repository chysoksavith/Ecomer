@extends('client.layouts.layout')
@section('content')
    <?php use App\Models\Product; ?>

    <div class="wrapperwishlist" style="margin-top: 61px">
        <div id="appendWishlist">
            @include('client.products.wishlist')
        </div>
    </div>
@endsection
