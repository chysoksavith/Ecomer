@extends('client.layouts.layout')
@section('content')
    <div class="MainMainContainerDetails">
        <div class="MainContainer">
            <div class="LeftContainerDetail">
                <div class="titleHomeDetaail">
                    <?php echo $categoryDetails->breadCrumb; ?>
                    {{-- <span class="HomeNAMEDT">
                        <a href="#">Home / </a>
                    </span>
                    <span class="ItemNameDet">Name Items</span> --}}
                </div>
                <div class="LeftImageZoom">

                    <div class="picZoomer img-container">
                        @if ($productDetails->images)
                            <img class="ImagePicXoom"
                                src="{{ asset('front/images/products/' . $productDetails->images[0]->image) }}"
                                id="mainImage">
                        @else
                            <span>No Image</span>
                        @endif


                    </div>
                    <ul class="piclist">
                        @foreach ($productDetails->images as $imge)
                            <li><img src="{{ asset('front/images/products/' . $imge->image) }} " class="subImage"></li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="RightContainerDetail">
                <ul class="MainRightDetail">
                    <li class="rightDet">
                        <div class="print-error-msg">

                        </div>
                        <div class="print-success-msg">

                        </div>
                        <div class="TitleProDT RightD">
                            <span>{{ $productDetails->product_name }}</span>
                        </div>
                    </li>
                    {{-- price and offer --}}
                    <li class="rightDet">
                        <div class="OfferPrice RightD getAttributePrice">
                            <span class="FinalPrice ">{{ $productDetails->final_price }}$</span>
                            {{-- <div class="DiscoAFinal"> --}}
                            @if ($productDetails->discount_type != '')
                                <span class="offerPercentage">( {{ $productDetails->product_discount }}% )</span>
                                <span class="dicPrice">{{ $productDetails->product_price }}$</span>
                            @endif
                            {{-- </div> --}}
                        </div>
                    </li>
                    {{-- Rateing --}}
                    <li class="rightDet">
                        <div class="OfferPrice RightD">
                            <div class="DiscoAFinal">
                                <span class="RatingIMg">( 100% )</span>
                                <span class="TotalReview">25 review</span>
                            </div>
                        </div>
                    </li>
                    {{-- Instock and left --}}
                    <li class="rightDet">
                        <div class="OfferPrice RightD InsOferr">
                            <div class="DiscoAFinal sf">
                                <div class="btnStock">
                                    <span class="Instock">20 inStock</span>
                                </div>
                                <div class="btnStock">
                                    <span class="Instock">20 inStock</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- Description --}}
                    <li class="rightDet">
                        <div class=" RightD Description">
                            <span>{{ $productDetails->description }}</span>
                        </div>
                    </li>
                    {{-- Color --}}
                    <form action="j" name="addToCart" id="addToCart">
                        <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                        <li class="rightDet">
                            @if (count($groupProducts) > 0)
                                <div class="RightD ColorSelected">
                                    <span class="TtitleColor"> Color : </span>
                                    <div class="selectedColor">
                                        <div class="checkSelecColor">
                                            @foreach ($groupProducts as $product)
                                                <a href="{{ url('product/' . $product->id) }}">
                                                    <div class="clor_radio">
                                                        <label style="background-color: {{ $product->product_color }}"
                                                            class="productColor"></label>
                                                    </div>
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endif
                       

                        </li>
                        {{-- Size --}}
                        <li class="rightDet">
                            <div class=" RightD ColorSelected">
                                <span class="TtitleColor"> Size : </span>
                                <div class="selectedSizes">
                                    @foreach ($productDetails->attributes as $attribute)
                                        <input class="btnsize getPrice" type="radio" id="{{ $attribute->size }}"
                                            name="size" value="{{ $attribute->size }}"
                                            product_id="{{ $productDetails->id }}" />
                                        <label for="{{ $attribute->size }}" class="btnsizeee">
                                            <span>{{ $attribute->size }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        {{-- Cart --}}
                        <li class="rightDet">
                            <div class=" RightD ColorSelected">
                                <div class="countInput">
                                    <div class="Decre"><span class="d-c">-</span></div>
                                    <div class="Num"> <input type="text" value="1" class="qty" name="qty"
                                            data-max="1000" data-min="1" readonly> </div>
                                    <div class="Decre"><span class="i-c">+</span></div>

                                    <div class="btCartDetail">
                                        <button type="submit" class="CartBtnDetail">ADD TO CART</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- wishlist --}}
                        <li class="rightDet">
                            <div class=" RightD ColorSelected">
                                <div class="wishLis">
                                    <span><i class="fa-regular   fa-heart  icoHead"></i></span>
                                    <span class="textwis">Add to Wish List</span>
                                </div>
                            </div>
                        </li>
                    </form>
                    {{-- policy --}}
                    <li class="rightDet">
                        <div class=" RightD ColorSelected">
                            <span class="TtitleColor"> Policy </span>
                            <div class="policyTex">
                                <ul class="ulPolicy">
                                    <li class="LiPolicy"><i class="fa-solid fa-check-double icoHead"></i><span
                                            class="txtPilicy">Buyer ProtectOrder</span></li>
                                    <li class="LiPolicy"><i class="fa-solid fa-check-double icoHead"></i><span
                                            class="txtPilicy">Buyer ProtectOrder</span></li>
                                    <li class="LiPolicy"><i class="fa-solid fa-check-double icoHead"></i><span
                                            class="txtPilicy">Buyer ProtectOrder</span></li>

                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        {{-- content tab detail revire video description --}}
        @include('client.products.content_tabDetails')
    </div>
    {{-- relate product --}}
    <div class="RelateProdTitle">
        <span class="youMayAlsolike">YOU MAY ALSO LIKE</span>
    </div>
    <div class="MainContainerFirstPage">
        @foreach ($relatedProducts as $product)
            <div class="ContainerFirstPage">
                <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                    <div class="ImageFirstPage">
                        @if (isset($product->images[0]->image) && !empty($product->images[0]->image))
                            <img src="{{ asset('front/images/products/' . $product->images[0]->image) }}" alt="">
                        @else
                            <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                alt="">
                        @endif
                        <span class="soldOutItems">SOLD OUT</span>
                    </div>
                    <div class="TitleFirstPage">
                        <span class="NameProFirstPage">{{ $product->product_name }}</span>
                        <span class="NameProFirstPageColor">{{ $product->product_color }}</span>
                        <div class="fial_price">
                            <span class="PriceFirstPage">{{ $product->final_price }}$</span>
                            @if ($product->discount_type != '')
                                <span class="PriceFirstPageoG">{{ $product->product_price }}$</span>
                            @endif

                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    {{-- customer view product --}}
    @if (count($recentProducts) > 0)
        <div class="RelateProdTitle">
            <span class="youMayAlsolike">CUSTOMERS ALSO VIEW PRODUCTS</span>
        </div>
        <div class="MainContainerFirstPage">
            @foreach ($recentProducts as $product)
                <div class="ContainerFirstPage">
                    <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                        <div class="ImageFirstPage">
                            @if (isset($product->images[0]->image) && !empty($product->images[0]->image))
                                <img src="{{ asset('front/images/products/' . $product->images[0]->image) }}"
                                    alt="">
                            @else
                                <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                    alt="">
                            @endif
                            <span class="soldOutItems">SOLD OUT</span>
                        </div>
                        <div class="TitleFirstPage">
                            <span class="NameProFirstPage">{{ $product->product_name }}</span>
                            <span class="NameProFirstPageColor">{{ $product->product_color }}</span>
                            <div class="fial_price">
                                <span class="PriceFirstPage">{{ $product->final_price }}$</span>
                                @if ($product->discount_type != '')
                                    <span class="PriceFirstPageoG">{{ $product->product_price }}$</span>
                                @endif

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    @endif

@endsection
@section('scripts')
    <script>
        function opanTab(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endsection
