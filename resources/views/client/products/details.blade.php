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
                    <li class="rightDet">
                        <div class=" RightD ColorSelected">
                            <span class="TtitleColor"> Color : </span>
                            <div class="selectedColor">
                                <div class="checkSelecColor">
                                    <input type="checkbox" name="" id="">
                                    <label for="" class="LabelNameColor">Black</label>
                                </div>

                            </div>
                        </div>
                    </li>
                    {{-- Size --}}
                    <li class="rightDet">
                        <div class=" RightD ColorSelected">
                            <span class="TtitleColor"> Size : </span>
                            <div class="selectedSizes">
                                @foreach ($productDetails->attributes as $attribute)
                                    <input class="btnsize getPrice" type="radio" id="{{$attribute->size}}" name="size" value="{{$attribute->size}}" product_id={{$productDetails->id}} >
                                    <label for="{{$attribute->size}}">{{$attribute->size}}</label>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    {{-- Size --}}
                    <li class="rightDet">
                        <div class=" RightD ColorSelected">
                            <div class="countInput">
                                <div class="Decre"><button class="d-c">-</button></div>
                                <div class="Num"> <input type="text" value="1" class="qty"
                                        wire:model="quantityCount" readonly> </div>
                                <div class="Decre"><button class="i-c" wire:click="incrementQty">+</button></div>

                                {{-- cart --}}
                                <div class="btCartDetail">
                                    <button type="button" class="CartBtnDetail">ADD TO CART</button>
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
@endsection
@section('scripts')
    <script>
        function openCity(evt, cityName) {
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

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
@endsection
