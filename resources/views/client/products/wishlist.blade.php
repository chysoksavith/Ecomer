@if (!is_null($userWishlistItem) && count($userWishlistItem) > 0)
    <div class="CartTtitle">
        <span class="cartTtispan">Wish List</span>
    </div>
    <div class="MainCartItems">
        <div class="coverItemCartAndClearAll">
            @foreach ($userWishlistItem as $item)
                <div class="cartItem">
                    <div class="ImageTitleCart">
                        <div class="CoverImageAll">
                            <div class="ImageCarts">
                                <a href="{{ url('product/' . $item['product']['id']) }}">
                                    <img src="{{ asset('front/images/products/' . $item['product']['images'][0]['image']) }}"
                                        alt="">
                                </a>
                            </div>
                            <div class="allInfoCart">
                                <ul class="infoProdcart">
                                    <li>
                                        <a href="{{ url('product/' . $item['product']['id']) }}"
                                            style="text-decoration: none; color: black;">
                                            <span class="ProdName">{{ $item['product']['product_name'] }}</span>
                                        </a>
                                    </li>
                                    <li><span class="spanDtProdcu">Code :
                                            {{ $item['product']['product_code'] }}</span></li>
                                    <li><span class="spanDtProdcu">Color :
                                            {{ $item['product']['product_color'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- delete cart --}}
                    <div class="removeCart">
                        <i class="fa-regular fa-trash-can deletewishlistItems"
                            data-wishlistid="{{ $item['id'] }}"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="cart_Empty">
        <span>
            <img src="{{ asset('front/images/empty.png') }}" alt="">
        </span>
        <span class="txtEmptyCart">
            You have no Wishlist items in your shopping cart.
        </span>
        <span class="emptybtn">
            <a href="{{ route('front.home') }}" class="BtnContinueS ">
                <button type="submit" class="CartDetail">Continue Shopping.</button>
            </a>
        </span>
    </div>
@endif
