<?php use App\Models\Product; ?>
<div class="cateShoop">
    <span>Home - </span>
</div>

<div class="CartTtitle">
    <span class="cartTtispan">Shopping Cart</span>
</div>
{{-- cart iterm --}}
@php
    $total_price = 0;
@endphp
@foreach ($getCartItems as $item)
    <?php
    $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
    ?>
    <div class="MainCartItems">
        <div class="cartItem">
            <div class="ImageTitleCart">
                <div class="CoverImageAll">
                    <div class="ImageCarts">
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
                    <div class="allInfoCart">
                        <ul class="infoProdcart">
                            <li>
                                <a href="{{ url('product/' . $item['product']['id']) }}"
                                    style="text-decoration: none; color: black;">
                                    <span class="ProdName">{{ $item['product']['product_name'] }}</span>
                                </a>
                            </li>
                            <li><span class="spanDtProdcu"> Brand {{ $item['product']['brand']['brand_name'] }}</span>
                            </li>
                            <li><span class="spanDtProdcu">Size {{ $item['product_size'] }}</span></li>
                            <li><span class="spanDtProdcu">Color {{ $item['product']['product_color'] }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="priceCart">
                {{-- {{ $item['product']['final_price'] * $item['product_qty'] }} $ --}}

                <div class=" getAttributePrice">
                    <span class="FinalPrice ">{{ $getAttributePrice['final_price'] * $item['product_qty'] }}$</span>
                    {{-- <div class="DiscoAFinal"> --}}
                    @if ($getAttributePrice['discount'] > 0)
                        <span class="offerPercentage">( {{ $getAttributePrice['discount_percent'] }}% )</span>
                        <span class="dicPrice">{{ $getAttributePrice['product_price'] * $item['product_qty'] }}$</span>
                    @endif
                    {{-- </div> --}}
                </div>

            </div>
            <div class="qtyCart">
                <div class="countInput">
                    <div class="Decre"><span class="fa-solid fa-minus updateCartItem qtyMinus"
                            data-cartid="{{ $item['id'] }}" data-qty="{{ $item['product_qty'] }}"></span></div>
                    <div class="Num"> <input type="text" value="{{ $item['product_qty'] }}" class="qty"
                            name="qty" data-max="1000" data-min="1" readonly> </div>
                    <div class="Decre"><span
                            class="fa-solid fa-plus  updateCartItem qtyPlus fa-plus"data-cartid="{{ $item['id'] }}"
                            data-qty="{{ $item['product_qty'] }}"></span></div>
                </div>
            </div>
            <div class="removeCart">
                <i class="fa-regular fa-trash-can deleteCartItems" data-cartid="{{ $item['id'] }}"></i>
            </div>
        </div>
    </div>

    @php
        $total_price = $total_price + $getAttributePrice['final_price'] * $item['product_qty'];
    @endphp
@endforeach

{{-- checkout section --}}
<div class="ContinueShopping">
    <span>
        <a href="javascript:;">
            <i class="fa-solid fa-arrow-left"></i>CONTINUE SHOPPING
        </a>
    </span>
    <span>
        @if (count($getCartItems) > 0)
            <a href="javascript:;" class="emptyCart">
                <i class="fa-regular fa-trash-can"></i> CLEAR CART
            </a>
        @endif

    </span>
</div>
<div class="checkOutSection">
    <div class="couponCode">
        <ul class="AplyCoupons">
            <li>
                <span class="appyCoupon">APPLY COUPON CDE</span>
            </li>
            <li>
                <span>Enter Coupon Code to Discount</span>
            </li>
            <li>
                <input type="text" class="inputCouopn" placeholder="Enter coupon Code">
            </li>
            <li>
                <button type="submit" class="CartDetail">APPLY</button>
            </li>
        </ul>
    </div>
    <div class="couponCode">
        <ul class="AplyCoupons">
            <li>
                <div class="subtoal">
                    <span>Sub Total</span>
                    <span>{{ $total_price }}$</span>
                </div>
            </li>
            <li>
                <div class="subtoal">
                    <span>Coupon Discount</span>
                    <span>111$</span>
                </div>
            </li>
            <li>
                <div class="subtoal">
                    <span>Grand Total</span>
                    <span>{{ $total_price }}$</span>
                </div>
            </li>
            <li>
                <button type="submit" class="CartDetail">CHECKOUT</button>
            </li>
        </ul>
    </div>
</div>
