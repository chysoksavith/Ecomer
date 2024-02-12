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
                        <div class="TitleProDT RightD ">
                            <span class="capitalize">{{ $productDetails->product_name }}</span>
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
                    <li class=" summary-detail">

                        <details onclick="handleDetailsClick(this)" class="detail_summary">
                            <summary>Review</summary>
                            <div class="productInfo ">
                                <div class="totalReview">
                                    <div class="base_review">
                                        <div class="wrapwrap-star">
                                            <div class="wrapper_basestar">
                                                <div class="rating_star">
                                                    <div>
                                                        <span class="base_reviewTotal">4.85</span>
                                                    </div>
                                                    <div class="starings">
                                                        <div class="clip-star"></div>
                                                        <div class="clip-star"></div>
                                                        <div class="clip-star"></div>
                                                        <div class="clip-star"></div>
                                                        <div class="clip-star"></div>
                                                    </div>
                                                </div>
                                                <span style="font-size: 14px">based on 13 reviews</span>
                                            </div>
                                            <div class="btnReview">
                                                <button type="button" class="CartBtnDetail" id="writeReviewBtn">Write
                                                    Review</button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="ratingStartBox" id="reviewSection" style="display: none;">
                                    <span class="ProdInfo"> What would you rate this product?</span>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    {{-- from rating --}}
                                    <div class="formRating">
                                        <div class="inputRating">
                                            <span class="ProdInfo">
                                                Tell us your feedback about the product
                                            </span>
                                            <textarea name="" rows="4"></textarea>
                                        </div>
                                        <div class="btnReview-Wrapper">
                                            <button type="button" class="ReviewBtn" id="cancelReviewBtn">Cancel</button>
                                            <button type="button" class="SubmitReviewBtn"
                                                id="cancelReviewBtn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- comment feedback user --}}
                                <div class="commentUser-wrapper ">
                                    <div class="DivTitle title_proReview">
                                        <span class="borderButtonSpan titleCmt">
                                            Product Reviews
                                        </span>
                                    </div>

                                    <div class="container_Cmt">
                                        <div class="box_comment">
                                            <div class="name_iconUser">
                                                {{-- icon --}}
                                                <div class="iconUserProf">
                                                    <img src="https://imgs.search.brave.com/vwimYLUDcAbT_ZWKjz9DlBVRoovzdUlB7dl-L8ZFB78/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/ZnJlZS1waG90by91/c2VyLXByb2ZpbGUt/ZnJvbnQtc2lkZV8x/ODcyOTktMzk1OTUu/anBnP3NpemU9NjI2/JmV4dD1qcGc"
                                                        alt="dc">
                                                </div>
                                                {{-- verify --}}
                                                <div class="verifyUser">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor" fill-rule="evenodd"
                                                            d="M15.418 5.643a1.25 1.25 0 0 0-1.34-.555l-1.798.413a1.25 1.25 0 0 1-.56 0l-1.798-.413a1.25 1.25 0 0 0-1.34.555l-.98 1.564c-.1.16-.235.295-.395.396l-1.564.98a1.25 1.25 0 0 0-.555 1.338l.413 1.8a1.25 1.25 0 0 1 0 .559l-.413 1.799a1.25 1.25 0 0 0 .555 1.339l1.564.98c.16.1.295.235.396.395l.98 1.564c.282.451.82.674 1.339.555l1.798-.413a1.25 1.25 0 0 1 .56 0l1.799.413a1.25 1.25 0 0 0 1.339-.555l.98-1.564c.1-.16.235-.295.395-.395l1.565-.98a1.25 1.25 0 0 0 .554-1.34L18.5 12.28a1.25 1.25 0 0 1 0-.56l.413-1.799a1.25 1.25 0 0 0-.554-1.339l-1.565-.98a1.25 1.25 0 0 1-.395-.395zm-.503 4.127a.5.5 0 0 0-.86-.509l-2.615 4.426l-1.579-1.512a.5.5 0 1 0-.691.722l2.034 1.949a.5.5 0 0 0 .776-.107z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="textverifyUser">Verified Customer</span>
                                                </div>
                                                <div class="nameUserReview">
                                                    <span class="textNameReiview">
                                                        Demo
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="cmmtingUser">
                                                <div class="starings">
                                                    <div class="clip-star starCmt"></div>
                                                    <div class="clip-star starCmt"></div>
                                                    <div class="clip-star starCmt"></div>
                                                    <div class="clip-star starCmt"></div>
                                                    <div class="clip-star starCmt"></div>
                                                </div>
                                                {{-- name item review --}}
                                                <div class="nameItemUserReview">
                                                    <span class="textNameiteREview">
                                                        hello
                                                    </span>
                                                </div>
                                                {{-- descroption user cmt --}}
                                                <div class="nameItemUserReview">
                                                    <p class="textDesiteREview">
                                                        hellosssssssssssssssssssssssssssssssssshellosssssssssssssssssssssssssssssssssshellosssssssssssssssssssssssssssssssssshellosssssssssssssssssssssssssssssssssshellosssssssssssssssssssssssssssssssssshellosssssssssssssssssssssssssssssssssshellossssssssssssssssssssssssssssssssss
                                                    </p>
                                                </div>
                                                {{-- date --}}
                                                <div class="nameItemUserReview dateReview">
                                                    <span class="date">
                                                        11 11 11
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </details>
                        {{-- detail prodict --}}
                        <details onclick="handleDetailsClick(this)" class="detail_summary">
                            <summary>Details</summary>
                            <div class="descriptionContent">
                                <div class="productInfo">
                                    <span class="ProdInfo">Specification:</span>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            <span class="prodt">Brand</span>
                                            <span class="prodt1">{{ $productDetails->brand->brand_name }}</span>
                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            <span class="prodt">Product Code</span>
                                            <span class="prodt1">{{ $productDetails->product_code }}</span>
                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            <span class="prodt">Product Color</span>
                                            <span class="prodt1">{{ $productDetails->product_color }}</span>
                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            @if (!empty($productDetails->fabric))
                                                <span class="prodt">Fabric</span>
                                                <span class="prodt1">{{ $productDetails->fabric }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            @if (!empty($productDetails->pattern))
                                                <span class="prodt">Pattern</span>
                                                <span class="prodt1">{{ $productDetails->pattern }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            @if (!empty($productDetails->fabric))
                                                <span class="prodt">Sleeve</span>
                                                <span class="prodt1">{{ $productDetails->sleeve }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            @if (!empty($productDetails->fabric))
                                                <span class="prodt">Fit</span>
                                                <span class="prodt1">{{ $productDetails->fit }}</span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            @if (!empty($productDetails->occasion))
                                                <span class="prodt">Occasion</span>
                                                <span class="prodt1">{{ $productDetails->occasion }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="detailPro">
                                        <div class="moreDetail">
                                            @if (!empty($productDetails->product_wieght))
                                                <span class="prodt">Shipping Wieght (Grams )</span>
                                                <span class="prodt1">{{ $productDetails->product_wieght }}</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>
                        {{-- vdo --}}
                        <details onclick="handleDetailsClick(this)" class="detail_summary">
                            <summary>Video</summary>
                            <div class="productInfo">
                                @if ($productDetails['product_video'])
                                    <video width="400px" controls>
                                        <source src="{{ url('front/videos/' . $productDetails['product_video']) }}"
                                            type="Video/mp4">
                                        Your browser does not support html video
                                    </video>
                                @else
                                    Product video does not exitsts
                                @endif
                            </div>
                        </details>
                        {{--  --}}
                        <details onclick="handleDetailsClick(this)" class="detail_summary">
                            <summary>Special Product Delivery</summary>
                            <p>Sub Category</p>
                        </details>
                    </li>
                    {{-- info --}}
                    <li class="rightDet info_detail_prod">
                        <div class="info_detail">
                            <div class="leftinFo">
                                <div class="icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 32 32">
                                        <path fill="currentColor"
                                            d="m29.81 16l-7-9.56A1 1 0 0 0 22 6H3a1 1 0 0 0-1 1v17a1 1 0 0 0 1 1h2.14a4 4 0 0 0 7.72 0h6.28a4 4 0 0 0 7.72 0H29a1 1 0 0 0 1-1v-7.44a1 1 0 0 0-.19-.56M20 8h1.49l5.13 7H20ZM9 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m14 0a2 2 0 1 1 2-2a2 2 0 0 1-2 2m5-3h-1.14a4 4 0 0 0-7.72 0h-6.28a4 4 0 0 0-7.72 0H4V8h14v9h10Z" />
                                    </svg>
                                </div>
                                <div class="content-wrapper detail_warp">
                                    Shipping in 24 hours
                                </div>
                            </div>
                            <div class="leftinFo">
                                <div class="icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 16 16">
                                        <g fill="currentColor">
                                            <path
                                                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                            <path d="M8 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="content-wrapper detail_warp">

                                    24/7 Customer Support
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        {{-- content tab detail revire video description --}}
    </div>
    {{-- relate product --}}
    <div class="RelateProdTitle">
        <span class="youMayAlsolike">You might also like</span>
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
            <span class="youMayAlsolike">Cutomers also view products</span>
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
        // function opanTab(evt, cityName) {
        //     var i, tabcontent, tablinks;
        //     tabcontent = document.getElementsByClassName("tabcontent");
        //     for (i = 0; i < tabcontent.length; i++) {
        //         tabcontent[i].style.display = "none";
        //     }
        //     tablinks = document.getElementsByClassName("tablinks");
        //     for (i = 0; i < tablinks.length; i++) {
        //         tablinks[i].className = tablinks[i].className.replace(" active", "");
        //     }
        //     document.getElementById(cityName).style.display = "block";
        //     evt.currentTarget.className += " active";
        // }

        // summary when click open summary 1 it open when click on 2 summry 1 close and summary 2 open
        function handleDetailsClick(clickedDetails) {
            const detailsElements = document.querySelectorAll('details');
            detailsElements.forEach(details => {
                if (details !== clickedDetails) {
                    details.removeAttribute('open');
                }
            });
        }
        // when click on wite review div rating open
        document.addEventListener('DOMContentLoaded', function() {
            const writeReviewBtn = document.getElementById('writeReviewBtn');
            const cancelReviewBtn = document.getElementById('cancelReviewBtn');
            const reviewSection = document.getElementById('reviewSection');

            writeReviewBtn.addEventListener('click', function() {
                reviewSection.style.display = 'block';
                writeReviewBtn.style.display = 'none';
            });

            cancelReviewBtn.addEventListener('click', function() {
                reviewSection.style.display = 'none';
                writeReviewBtn.style.display = 'block';
            });
        });
    </script>
@endsection
