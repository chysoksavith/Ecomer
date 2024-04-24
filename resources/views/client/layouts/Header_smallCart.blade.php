<?php
use App\Models\Product;
$getCartItems = getCartItems();
?>

<div class="backdrop_cart"></div>

<div class="side_Cart_wrapper">

    <div class="containerIcons">
        <span class="closeCart"style="cursor: pointer;">
            <i class="fa-solid fa-xmark"></i>
        </span>
    </div>
    {{-- <span class="closeFilter" style="display:none;">X</span> --}}
    @php
        $total_price = 0;
    @endphp

    @if (count($getCartItems) > 0)
        @foreach ($getCartItems as $item)
            <?php
            $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
            ?>
            <div class="minicartItems">
                <div class="miniCartStyle">
                    <div class="miniCartImage">
                        <div class="MiniImageCarts">
                            @if (isset($item['product']['images'][0]['image']) && !empty($item['product']['images'][0]['image']))
                                <a href="{{ url('product/' . $item['product']['id']) }}">
                                    <img src="{{ asset('front/images/products/' . $item['product']['images'][0]['image']) }}"
                                        alt="">
                                </a>
                            @else
                                <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                    alt="">
                            @endif

                        </div>
                    </div>
                    <div class="miniCartTitle">
                        <span class="nMiniCart">
                            <a href="{{ url('product/' . $item['product']['id']) }}"
                                style="text-decoration: none; color: black;">
                                <span class="ProdName">{{ $item['product']['product_name'] }}</span>
                            </a>
                        </span>
                        <span class="nameMiniCart">
                            Brand
                            {{ $item['product']['brand']['brand_name'] }}
                        </span>
                        <span class="nameMiniCart">
                            Qty {{ $item['product_qty'] }}
                        </span>
                        <span class="nameMiniCart">
                            Size {{ $item['product_size'] }}
                        </span>
                        <span class="nameMiniCart">
                            Color {{ $item['product']['product_color'] }}
                        </span>


                    </div>
                    <div class="miniremoveCart">
                        <i class="fa-regular fa-trash-can deleteCartItems" data-cartid="{{ $item['id'] }}"></i>
                    </div>
                </div>

            </div>
            @php
                $total_price = $total_price + $getAttributePrice['final_price'] * $item['product_qty'];
            @endphp
        @endforeach
        {{-- sub minitotal --}}
        <div class="subminital">
            <span class="cartsubtotal">Cart Subtotal</span>

            @php
                $couponAmount = Session::has('couponAmount') ? Session::get('couponAmount') : 0;
                $grand_total = $total_price - $couponAmount;
            @endphp
            <span class="subPrice orderTotal grandTotal miniCartTotalPrice">
                {{ $grand_total }}$
            </span>
            {{-- cart checkout and process --}}
            <div class="cartButtonCheckoutmini">
                <a class="aCartmini" href="{{ url('cart') }}">
                    <button type="submit" class="CartminiBtnDetail">View Cart</button>
                </a>
                <a class="aCartmini" href="{{ url('checkout') }}">

                    <button type="submit" class="CartminiBtnDetail1">Checkout</button>
                </a>
            </div>
        </div>
    @else
        <div class="empty-cart-message">
            <p class="emptyP">Your cart is empty. Start shopping now!</p>
            <a class="aCartmini" href="{{ route('front.home') }}">
                <button type="submit" class="CartminiBtnDetail">Shopping Now</button>
            </a>
        </div>
    @endif
</div>
