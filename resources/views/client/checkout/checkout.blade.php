@extends('client.layouts.layout')

@section('content')
    <?php
    use App\Models\Product;
    ?>


    <div class="checkout-wrapper">
        <div class="checkout-header">
            <span class="checkout-title">
                Checkout
            </span>
            <span class="checkout-description">
                Please enter your details below to complete your purchase
            </span>
        </div>

        <div class="checkoutMain-part">
            <div class="shippingInfo-checkout check-wrapp">
                <div class="titleShiption">
                    <span>Delivery Address</span>
                </div>
                <div id="deliveryAddress">
                    @include('client.checkout.delivery_address')
                </div>
                <div class="titleShiption" style="margin-top: 25px">
                    <span class="deliveryText">Add New Delivery Address</span>
                </div>
                <div class="form-New-addressCheckout">
                    <form name="addressAddEditForm" id="addressAddEditForm" action="javascript:;" method="post">
                        @csrf
                        <input type="hidden" name="delivery_id">
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Name <span class="redValidation">*</span></label>
                            <input type="text" id="delivery_name" name="delivery_name" class="inputLogin">
                            <div id="delivery_name-error" class="error"></div>

                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Address <span class="redValidation">*</span></label>
                            <input type="text" id="delivery_address" name="delivery_address" class="inputLogin">
                            <div id="delivery_address-error" class="error"></div>

                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">City <span class="redValidation">*</span></label>
                            <input type="text" id="delivery_city" name="delivery_city" class="inputLogin">
                            <div id="delivery_city-error" class="error"></div>

                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">State <span class="redValidation">*</span></label>
                            <input type="text" id="delivery_state" name="delivery_state" class="inputLogin">
                            <div id="delivery_state-error" class="error"></div>

                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Country <span class="redValidation">*</span></label>
                            <select name="delivery_country" id="delivery_country" class="inputLogin">
                                <option value="" selected>Select Your Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country['country_name'] }}"
                                        @if ($country['country_name'] == Auth::user()->country) selected @endif>
                                        {{ $country['country_name'] }}
                                    </option>
                                @endforeach
                            </select>

                            <div id="delivery_country-error" class="error"></div>

                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">PinCode <span class="redValidation">*</span></label>
                            <input type="text" id="delivery_pincode" name="delivery_pincode" class="inputLogin">
                            <div id="delivery_pincode-error" class="error"></div>
                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Mobile <span class="redValidation">*</span></label>
                            <input type="number" id="delivery_mobile" name="delivery_mobile" class="inputLogin">
                            <div id="delivery_mobile-error" class="error"></div>
                        </div>
                        {{-- <div class="inputFiel showPass">
                            <input type="checkbox" class="checkboxshowpass">

                            <span class="showPasswordTxt">
                                Make this default delivery address
                            </span>
                        </div> --}}
                        <div class="inputFiel">
                            <button type="submit" id="btnShipping" class="BtnApplyDiscount">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- option --}}

            <div class="optionCash-checkout check-wrapp">
                <form action="{{ url('/checkout') }}" name="checkOutForm" id="checkOutForm" method="post">

                    {{-- payment method --}}
                    <div class="titleShiption">
                        <span>Payment Method</span>
                    </div>
                    @csrf
                    <div class="radio-list">
                        <div class="radio-item">
                            <input type="radio" name="payment_geteway" id="radioCashOnDelivery" value="COD">
                            <label for="radioCashOnDelivery">Cash On Delivery</label>
                        </div>
                        <div style="padding: 15px; font-size: 14px;">
                            <span style="color: #999999;">
                                (This service is only available for some country)
                            </span>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="payment_geteway" id="radioDirectBank" value="Bank Tranfer">
                            <label for="radioDirectBank">Direct Bank Transfer</label>
                        </div>
                        <div style="padding: 15px; font-size: 14px;">
                            <span style="color: #999999;">
                                (Make your payment direct into our bank account, Please use your ID as Payment reference)
                            </span>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="payment_geteway" id="radioPaywithCheck" value="Check">
                            <label for="radioPaywithCheck">Pay with Check</label>
                        </div>
                        <div style="padding: 15px; font-size: 14px;">
                            <span style="color: #999999;">
                                (Please send check to store Name,)
                            </span>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="payment_geteway" id="radioPayPal" value="Paypal">
                            <label for="radioPayPal">PayPal (With Credit/ Debit Card/ PayPal Credit)</label>
                        </div>
                        <div style="padding: 15px; font-size: 14px;">
                            <span style="color: #999999;">
                                (When you click (Place order) below will take you to PayPal is site to make Payment)
                            </span>
                        </div>

                    </div>

            </div>
            {{-- cart detail --}}
            <div class="checkout-Cart  check-wrapp">
                <div class="titleShiption">
                    <span>Order Summary</span>
                </div>
                {{-- cart --}}
                <div class="checkoutCart-wrapper">
                    @php
                        $total_price = 0;
                    @endphp
                    @foreach ($getCartItems as $cartItems)
                        <?php $getAttributePrice = Product::getAttributePrice($cartItems['product_id'], $cartItems['product_size']);
                        ?>
                        <div class="checkOutCart-containers">
                            @if (isset($cartItems['product']['images'][0]['image']) && !empty($cartItems['product']['images'][0]['image']))
                                <div class="checkImgDesc-wrapper">
                                    <img src="{{ asset('front/images/products/' . $cartItems['product']['images'][0]['image']) }}"
                                        alt="" class="imgcheckout">
                                </div>
                            @else
                                <div class="checkImgDesc-wrapper">
                                    <img src="" alt="No Images" class="imgcheckout">
                                </div>
                            @endif

                            <div class="descCheckoutCart detailCHeckitem">
                                <div class="productNameCHECK">
                                    <span class="checkProductName">Product Name:
                                        {{ $cartItems['product']['product_name'] }} </span>
                                </div>
                                <div class="productNameCHECK">
                                    <span class="QtyCheckout">size: </span>
                                    <span class="QtyCheckout">{{ $cartItems['product_size'] }}</span>
                                </div>
                                <div class="productNameCHECK">
                                    <span class="QtyCheckout">Qty: </span>
                                    <span class="QtyCheckout">{{ $cartItems['product_qty'] }}</span>
                                </div>
                                <div class="productNameCHECK">
                                    <span
                                        class="checkoutTotal">{{ $getAttributePrice['final_price'] * $cartItems['product_qty'] }}
                                        $</span>
                                </div>
                            </div>
                            <div class="descCheckoutCart">
                                <div class="productNameCHECK">
                                    <a href="javascript:;" class="btnDeleteCartInCheckout deleteCartItems"
                                        data-cartid="{{ $cartItems['id'] }}" data-page="Checkout">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 48 48">
                                            <g fill="none" stroke="#000" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4">
                                                <path d="M8 8L40 40" />
                                                <path d="M8 40L40 8" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @php
                            $total_price = $total_price + $getAttributePrice['final_price'] * $cartItems['product_qty'];
                        @endphp
                    @endforeach


                </div>
                {{-- billing address --}}
                <div class="titleShiption">
                    <span>Billing Address</span>
                </div>
                <div class="billoutContrainer">
                    <ul>
                        <li>
                            <span class="h1Billing">
                                Bill toL
                            </span>
                        </li>
                        <li>
                            <span class="">
                                {{ Auth::user()->name }}
                            </span>
                        </li>
                        <li class="editBill">
                            <span class="">
                                @if (!empty(Auth::user()->address))
                                    {{ Auth::user()->address }},
                                @endif
                                @if (!empty(Auth::user()->city))
                                    {{ Auth::user()->city }},
                                @endif
                                @if (!empty(Auth::user()->state))
                                    {{ Auth::user()->state }},
                                @endif
                                @if (!empty(Auth::user()->country))
                                    {{ Auth::user()->country }},
                                @endif
                                @if (!empty(Auth::user()->mobile))
                                    {{ Auth::user()->mobile }},
                                @endif
                            </span>
                            <a href="{{ url('user/account') }}" class="btnDeleteCartInCheckout"
                                style="text-decoration: none; color: black;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 16 16">
                                    <path fill="currentColor"
                                        d="M15.49 7.3h-1.16v6.35H1.67V3.28H8V2H1.67A1.21 1.21 0 0 0 .5 3.28v10.37a1.21 1.21 0 0 0 1.17 1.25h12.66a1.21 1.21 0 0 0 1.17-1.25z" />
                                    <path fill="currentColor"
                                        d="M10.56 2.87L6.22 7.22l-.44.44l-.08.08l-1.52 3.16a1.08 1.08 0 0 0 1.45 1.45l3.14-1.53l.53-.53l.43-.43l4.34-4.36l.45-.44l.25-.25a2.18 2.18 0 0 0 0-3.08a2.17 2.17 0 0 0-1.53-.63a2.19 2.19 0 0 0-1.54.63l-.7.69l-.45.44zM5.51 11l1.18-2.43l1.25 1.26zm2-3.36l3.9-3.91l1.3 1.31L8.85 9zm5.68-5.31a.91.91 0 0 1 .65.27a.93.93 0 0 1 0 1.31l-.25.24l-1.3-1.3l.25-.25a.88.88 0 0 1 .69-.25z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- total checkout --}}
                <div class="TotalCheckOut">
                    <ul class="AplyCoupons">
                        <li>
                            <div class="subtoal">
                                <span class="subPrice">Sub Total</span>
                                <span class="subPrice">{{ $total_price }}$</span>
                            </div>
                        </li>
                        <li>
                            <div class="subtoal">
                                <span class="subPrice">Shippign</span>
                                <span class="subPrice">f$</span>
                            </div>
                        </li>
                        <li>
                            <div class="subtoal">
                                <span class="subPrice">Tax</span>
                                <span class="subPrice">f$</span>
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
                        <li>
                            <div class="inputFiel showPass">
                                <input type="checkbox" class="checkboxshowpass" name="agree" value="Yes">

                                <span class="showPasswordTxt" style=" font-size: 14px">
                                    I consent to the <a href=""
                                        style=" color: orange; text-decoration: none; font-weight: 600">Terms of
                                        service</a>
                                </span>
                            </div>
                            <div class="inputFiel">
                                <button type="submit" class="BtnApplyDiscount">Place Order</button>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
            </form>

        </div>
    </div>
@endsection


<!-- Your HTML content here -->
