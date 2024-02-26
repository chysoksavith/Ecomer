<?php use App\Models\Product; ?>


@if (count($getCartItems) > 0)
    <div class="cateShoop">
        <span>Home - </span>
    </div>

    <div class="CartTtitle">
        <span class="cartTtispan">Shopping Cart</span>
    </div>
    <div class="MainCartItems">

        <div class="coverItemCartAndClearAll">
            {{-- cart iterm --}}
            @php
                $total_price = 0;
            @endphp
            @foreach ($getCartItems as $item)
                <?php
                $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
                ?>
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
                                    <li><span class="spanDtProdcu"> Brand
                                            {{ $item['product']['brand']['brand_name'] }}</span>
                                    </li>
                                    <li><span class="spanDtProdcu">Size {{ $item['product_size'] }}</span></li>
                                    <li><span class="spanDtProdcu">Color {{ $item['product']['product_color'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="priceCart">
                        <div class=" getAttributePrice">
                            <span
                                class="FinalPrice ">{{ $getAttributePrice['final_price'] * $item['product_qty'] }}$</span>
                            {{-- <div class="DiscoAFinal"> --}}
                            @if ($getAttributePrice['discount'] > 0)
                                <span class="offerPercentage">( {{ $getAttributePrice['discount_percent'] }}% )</span>
                                <span
                                    class="dicPrice">{{ $getAttributePrice['product_price'] * $item['product_qty'] }}$</span>
                            @endif
                            {{-- </div> --}}
                        </div>

                    </div>
                    <div class="qtyCart">
                        <div class="countInput">
                            <div class="Decre"><span class="fa-solid fa-minus updateCartItem qtyMinus"
                                    data-cartid="{{ $item['id'] }}" data-qty="{{ $item['product_qty'] }}"></span>
                            </div>
                            <div class="Num"> <input type="text" value="{{ $item['product_qty'] }}"
                                    class="qty" name="qty" data-max="1000" data-min="1" readonly> </div>
                            <div class="Decre"><span
                                    class="fa-solid fa-plus  updateCartItem qtyPlus fa-plus"data-cartid="{{ $item['id'] }}"
                                    data-qty="{{ $item['product_qty'] }}"></span></div>
                        </div>
                    </div>
                    {{-- delete cart --}}
                    <div class="removeCart">
                        <i class="fa-regular fa-trash-can deleteCartItems" data-cartid="{{ $item['id'] }}"></i>
                    </div>
                </div>
                @php
                    $total_price = $total_price + $getAttributePrice['final_price'] * $item['product_qty'];
                @endphp
            @endforeach

            <div class="cartContion_Clearall">
                <div class="mainCartContion">
                    <a href="{{ route('front.home') }}" class="BtnContinueS">
                        <button type="submit" class="CartDetail">Continue Shopping</button>
                    </a>
                    <a href="javascript:;" class="emptyCart BtnContinueS">
                        <button type="submit" class="CartDetail">Clear Shopping Cart</button>
                    </a>
                </div>
            </div>
        </div>
        {{-- Process to checkout --}}


        <div class="process_checkot checkOutSection">
            <span class="processTxt">
                Summary
            </span>
            <div class="couponCode">
                <ul class="AplyCoupons">
                    <li>
                        <div class="subtoal">
                            <span class="subPrice">Sub Total</span>
                            <span class="subPrice">{{ $total_price }}$</span>
                        </div>
                    </li>
                    <li>
                        <div class="subtoal">
                            <span class="subPrice">Coupon Discount</span>
                            <span class="subPrice couponAmount">
                                @php
                                    $couponAmount = Session::get('couponAmount');
                                    echo $couponAmount ? $couponAmount . '$' : '0$';
                                @endphp
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="db">
                            <span class="subPrice">Order Total</span>
                            @php
                                $couponAmount = Session::has('couponAmount') ? Session::get('couponAmount') : 0;
                                $grand_total = $total_price - $couponAmount;
                            @endphp
                            <span class="subPrice orderTotal grandTotal">
                                {{ $grand_total }}$
                            </span>

                        </div>
                    </li>
                </ul>
                {{-- Apply Coupon --}}
                <div class="dfapply">
                    <details>
                        <summary class="summaryCart"> <span class="applyCou">Apply Discount Coupon</span></summary>
                        <form action="javascript:;" method="post" class="f-cart">
                            @csrf
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Enter Discount Code </label>
                                <input type="text" id="code" name="code" class="inputLogin"
                                    placeholder="Enter Discount Code">
                            </div>
                            <div class="applyCodebtn">
                                <button id="ApplyCoupon" type="submit" class="BtnApplyDiscount"
                                    @if (Auth::check()) user="1" @endif>Apply
                                    Discount</button>
                            </div>
                        </form>
                    </details>
                </div>
                {{-- checkout btn --}}
                <div class="applyCodebtn">
                    <a href="{{ url('checkout') }}" style="text-decoration: none;">
                        <button type="submit" class="BtnApplyDiscount">Process To Checkout</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
@else
    <div class="cart_Empty">
        <span>
            <img src="{{ asset('front/images/empty.png') }}" alt="">
        </span>
        <span class="txtEmptyCart">
            You have no items in your shopping cart.
        </span>
        <span class="emptybtn">
            <a href="{{ route('front.home') }}" class="BtnContinueS ">
                <button type="submit" class="CartDetail">Continue Shopping.</button>
            </a>
        </span>
    </div>
@endif
