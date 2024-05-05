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
                    <div class="zoom__img">
                        <div class="picZoomer img-container" id="zoomPicture">
                            <div class="react" id="react"></div>
                            @if ($productDetails->images)
                                <img class="ImagePicXoom"
                                    src="{{ asset('front/images/products/' . $productDetails->images[0]->image) }}"
                                    id="mainImage">
                            @else
                                <span>No Image</span>
                            @endif
                            <!-- Zoom Icon -->
                            <div class="zoom-icon" id="zoomIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="zoom">
                                    <path
                                        d="M20 9V5.41L13.41 12 20 18.59V15a1 1 0 0 1 2 0v6a1 1 0 0 1-1 1h-6a1 1 0 0 1 0-2h3.59L12 13.41 5.41 20H9a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1v-6a1 1 0 0 1 2 0v3.59L10.59 12 4 5.41V9a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1h6a1 1 0 0 1 0 2H5.41L12 10.59 18.59 4H15a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0Z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="zoom" id="zoom">
                        <!-- Zoomed Image -->
                        <div class="zoomed-image-container">
                            <img class="zoomed-image" id="zoomedImage">
                            <!-- Close Button -->
                            <span class="close-btn" id="closeBtn">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <!-- Zoom In/Zoom Out Buttons -->
                            <div class="zoom-buttons">
                                <span class="zoom-in-btn" id="zoomInBtn">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                <span class="zoom-out-btn" id="zoomOutBtn">
                                    <i class="fa-solid fa-minus"></i>
                                </span>
                            </div>
                        </div>
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
                            <div class="divPricedetail">
                                <span class="FinalPrice ">{{ $productDetails->final_price }}$</span>

                            </div>

                            {{-- <div class="DiscoAFinal"> --}}
                            @if ($productDetails->discount_type != '')
                                <span class="offerPercentage">( {{ $productDetails->product_discount }}% )</span>
                                <span class="dicPrice">{{ $productDetails->product_price }}$</span>
                            @endif
                            {{-- </div> --}}
                        </div>
                    </li>
                    <li class="rightDet">
                        <div class="sKUsTOCK">
                            @if ($totalStock > 0)
                                <span class="ins">In Stock</span>
                            @else
                                <span class="ins">Out of Stock</span>
                            @endif

                            <span class="sk">Code {{ $productDetails->product_code }}</span>
                        </div>
                    </li>
                    {{-- Rateing --}}
                    <li class="rightDet">
                        <div class="OfferPrice RightD">
                            <div class="">
                                <div class="starings DiscoAFinal">

                                    @if ($avgStartRating > 0)
                                        @php
                                            $star = 1;
                                            while ($star <= $avgStartRating) {
                                                echo '<div class="clip-star"></div>';
                                                $star++;
                                            }
                                        @endphp
                                        <span class="TotalReview"> ({{ $rating->total() }} review)</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- Description --}}
                    <li class="rightDet">
                        <div class="RightD Description">
                            <span>{!! $productDetails->description !!}</span>
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
                            {{-- @if (count($groupProducts) > 0)
                                @foreach ($groupProducts as $products)
                                    <a href="{{ url('product/' . $products->id) }}">
                                        <img src="{{ asset('front/images/products/' . $products->images[0]->image) }}"
                                            alt="">
                                    </a>
                                @endforeach
                            @endif --}}

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
                                    @php
                                        $countWishList = 0;
                                    @endphp
                                    @php
                                        $wishlist = new App\Models\Wishlist();
                                        $countWishList = $wishlist->countWishList($productDetails->id);
                                    @endphp
                                    <span class="updateWishlist" data-productid="{{ $productDetails->id }}">
                                        <i
                                            class=" @if ($countWishList > 0) fa-solid fa-heart @else  fa-regular   fa-heart @endif icoHead"></i>
                                    </span>
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
                                                        <span class="base_reviewTotal">{{ $avgRating }}</span>
                                                    </div>
                                                    <div class="starings">
                                                        @if ($avgStartRating > 0)
                                                            @php
                                                                $star = 1;
                                                                while ($star <= $avgStartRating) {
                                                                    echo '<div class="clip-star"></div>';
                                                                    $star++;
                                                                }
                                                            @endphp
                                                        @endif
                                                    </div>
                                                </div>
                                                <span style="font-size: 14px">based on {{ $rating->total() }}
                                                    reviews</span>
                                            </div>
                                            <div class="btnReview">
                                                <button type="button" class="CartBtnDetail" id="writeReviewBtn">Write
                                                    Review</button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                {{-- rating star --}}
                                <form name="formRating" id="formRating">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                    <div class="ratingStartBox" id="reviewSection" style="display: none;">
                                        <span class="ProdInfo"> What would you rate this product?</span>
                                        <div class="rate">
                                            <input style="display: none;" type="radio" id="star5" name="rating"
                                                value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input style="display: none;" type="radio" id="star4" name="rating"
                                                value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input style="display: none;" type="radio" id="star3" name="rating"
                                                value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input style="display: none;" type="radio" id="star2" name="rating"
                                                value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input style="display: none;" type="radio" id="star1" name="rating"
                                                value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        {{-- from rating --}}
                                        <div class="formRating">
                                            <div class="inputRating">
                                                <span class="ProdInfo">
                                                    Tell us your feedback about the product
                                                </span>
                                                <textarea name="review" rows="4"></textarea>
                                            </div>
                                            <div class="btnReview-Wrapper">
                                                <button type="button" class="ReviewBtn"
                                                    id="cancelReviewBtn">Cancel</button>
                                                <button type="submit" class="SubmitReviewBtn"
                                                    id="submitReviewBtn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                {{-- comment feedback user --}}
                                <div class="commentUser-wrapper ">
                                    <div class="DivTitle title_proReview">
                                        <span class="borderButtonSpan titleCmt">
                                            Product Reviews
                                        </span>
                                    </div>

                                    <div class="container_Cmt">
                                        <div id="appendContain_cmt">
                                            @include('client.partials.box_comment')
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
                                            @if (!empty($productDetails->product_weight))
                                                <span class="prodt">Shipping Wieght (Grams )</span>
                                                <span class="prodt1">{{ $productDetails->product_weight }} g</span>
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
    @include('client.products.relate_product')
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('mainImage');
            const zoomIcon = document.getElementById('zoomIcon');
            const zoomedImageContainer = document.querySelector('.zoomed-image-container');
            const zoomedImage = document.getElementById('zoomedImage');
            const closeBtn = document.getElementById('closeBtn');
            const zoomInBtn = document.getElementById('zoomInBtn');
            const zoomOutBtn = document.getElementById('zoomOutBtn');

            let zoomLevel = 100; // Initial zoom level
            const maxZoom = 300; // Maximum zoom level
            const minZoom = 50; // Minimum zoom level

            // Function to show zoomed image in pop-up container
            function showZoomedImage() {
                zoomedImage.src = mainImage.src;
                zoomedImageContainer.style.display = 'flex';
            }

            // Zoom icon click action
            zoomIcon.addEventListener('click', showZoomedImage);



            // Close button action
            function closeZoomedImage() {
                zoomedImageContainer.style.display = 'none';
                // Reset zoom level when closing
                zoomLevel = 100;
                zoomedImage.style.transform = `scale(1)`; // Reset to original size
            }

            closeBtn.addEventListener('click', closeZoomedImage);

            // Zoom in button action
            zoomInBtn.addEventListener('click', function() {
                if (zoomLevel < maxZoom) {
                    zoomLevel += 10; // Increase zoom level by 10%
                    zoomedImage.style.transform = `scale(${zoomLevel / 100})`; // Apply zoom
                }
            });

            // Zoom out button action
            zoomOutBtn.addEventListener('click', function() {
                if (zoomLevel > minZoom) {
                    if (zoomLevel > 100) {
                        zoomLevel -= 10; // Decrease zoom level by 10% if above original size
                        zoomedImage.style.transform = `scale(${zoomLevel / 100})`; // Apply zoom
                    }
                }
            });

            // Close pop-up container when zoomed image is clicked
            zoomedImage.addEventListener('click', closeZoomedImage);
        });


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
