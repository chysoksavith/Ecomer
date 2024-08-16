@extends('client.layouts.layout')
@section('content')
    <?php use App\Models\Product;
    ?>
    @if (count($homeSliderBanner) > 0)
        <section>
            <div class="popup-overlay">
                <div class="bannerIndex">
                    @foreach ($homeSliderBanner as $sliderBanner)
                        <div class="BannerImage">
                            <img src="{{ asset('front/images/banner/' . $sliderBanner->image) }}" alt="">
                            <div class="divInfBanner">
                                <span class="titleInfo">
                                    Now Live
                                </span>
                                <span class="middletextBanner">
                                    {{ $sliderBanner->title }}
                                </span>
                                <a href="{{ $sliderBanner->link }}" class="popup-btn" style="text-decoration: none;">
                                    <button type="submit" class="bannerBtn">Discover</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (count($NewProducts) > 0)
        <section>
            <div class="DivTitle" data-aos="fade-right"><span class="borderButtonSpan">New Arrivals</span></div>
            <div class="MainContainerFirstPage">
                @foreach ($NewProducts as $product)
                    <div class="ContainerFirstPage" data-aos="fade-up">
                        <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                            <div class="ImageFirstPage">
                                @if (isset($product->images[0]->image) && !empty($product->images[0]->image))
                                    <img src="{{ asset('front/images/products/' . $product->images[0]->image) }}"
                                        alt="" class="primary-image">
                                @else
                                    <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                        alt=""class="primary-image">
                                @endif
                                {{-- secondary image --}}
                                @if (isset($product->images[1]->image) && !empty($product->images[1]->image))
                                    <img src="{{ asset('front/images/products/' . $product->images[1]->image) }}"
                                        alt="" class="secondary-image">
                                @else
                                    <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                        alt="" class="secondary-image">
                                @endif
                                {{-- <span class="soldOutItems">SOLD OUT</span> --}}
                            </div>
                            <div class="TitleFirstPage">
                                <span class="NameProFirstPage">{{ $product->product_name }}</span>
                                <span class="NameProFirstPageColor capitalize">{{ $product->brand->brand_name }}</span>
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
        </section>
    @endif
    {{-- Best Seller Product --}}
    @if (count($BestSeller) > 0)
        <section>
            <div class="DivTitle" data-aos="fade-right"><span class="borderButtonSpan">Best Seller</span></div>
            <div class="MainContainerFirstPage">
                @foreach ($BestSeller as $ProductBestSeller)
                    <div class="ContainerFirstPage" data-aos="fade-up">
                        <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                            <div class="ImageFirstPage">
                                @if (isset($ProductBestSeller->images[0]->image) && !empty($ProductBestSeller->images[0]->image))
                                    <img src="{{ asset('front/images/products/' . $ProductBestSeller->images[0]->image) }}"
                                        alt="">
                                @else
                                    <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                        alt="">
                                @endif
                                {{-- <span class="soldOutItems">SOLD OUT</span> --}}
                            </div>
                            <div class="TitleFirstPage">
                                <span class="NameProFirstPage">{{ $ProductBestSeller->product_name }}</span>
                                <span class="NameProFirstPageColor capitalize">{{ $product->brand->brand_name }}</span>
                                <div class="fial_price">
                                    <span class="PriceFirstPage">{{ $ProductBestSeller->final_price }}$</span>
                                    @if ($ProductBestSeller->discount_type != '')
                                        <span class="PriceFirstPageoG">{{ $ProductBestSeller->product_price }}$</span>
                                    @endif

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </section>
    @endif

    {{-- banner 2 --}}
    <section class="banner_two ">
        <div class="banner_wrapper">
            <div class="banner_left_two">


                @if (count($homeFixBanner) >= 2)
                    @if (isset($homeFixBanner[0]['image']))
                        <!-- Changed index from 1 to 0 for the first banner -->
                        <div class="child_banner_two" data-aos="fade-up">
                            <img src="{{ asset('front/images/banner/' . $homeFixBanner[0]['image']) }}" alt="">
                            <div class="textFixbanner">
                                <div class="wrapperAhrefFixbanne">
                                    <span class="TitleFixBanner">
                                        {{ $homeFixBanner[0]['title'] }}
                                        <!-- Changed index from 1 to 0 for the first banner -->
                                    </span>
                                </div>
                                <a href="{{ url($homeFixBanner[0]['link']) }}" class="aHrefFix">
                                    <button class="btnFixBanner">
                                        Click Now
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (isset($homeFixBanner[1]['image']))
                        <!-- Changed index from 2 to 1 for the second banner -->
                        <div class="child_banner_two" data-aos="fade-up">
                            <img src="{{ asset('front/images/banner/' . $homeFixBanner[1]['image']) }}" alt="">
                            <div class="textFixbanner">
                                <div class="wrapperAhrefFixbanne">
                                    <span class="TitleFixBanner">
                                        {{ $homeFixBanner[1]['title'] }}
                                        <!-- Changed index from 2 to 1 for the second banner -->
                                    </span>
                                </div>
                                <a href="{{ url($homeFixBanner[1]['link']) }}" class="aHrefFix">
                                    <button class="btnFixBanner">
                                        Click Now
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif


            </div>
            <div class="banner_right_two" data-aos="fade-up">
                @if (isset($homeFixBanner[2]['image']))
                    <!-- Changed index from 2 to 2 for the second banner -->
                    <div class=" child_banner_three">
                        <img src="{{ asset('front/images/banner/' . $homeFixBanner[2]['image']) }}" alt="">
                        <div class="textFixbannerthree">

                            <div class="wrapperAhrefFixbanne">
                                <span class="TitleFixBanner">
                                    {{ $homeFixBanner[2]['title'] }}
                                    <!-- Changed index from 2 to 2 for the second banner -->
                                </span>
                            </div>
                            <a href="{{ url($homeFixBanner[2]['link']) }}" class="aHrefFix">
                                <button class="btnFixBanner">
                                    Click Now
                                </button>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    {{-- duscount Product --}}
    @if (count($discountProducts) > 0)
        <section>
            <div class="DivTitle" data-aos="fade-right"><span class="borderButtonSpan">Discount Product</span></div>
            <div class="MainContainerFirstPage">
                @foreach ($discountProducts as $discountProduct)
                    <div class="ContainerFirstPage" data-aos="fade-up">
                        <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">

                            <div class="ImageFirstPage">
                                @if (isset($discountProduct->images[0]->image) && !empty($discountProduct->images[0]->image))
                                    <img src="{{ asset('front/images/products/' . $discountProduct->images[0]->image) }}"
                                        alt="">
                                @else
                                    <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                        alt="">
                                @endif
                                {{-- <span class="soldOutItems">SOLD OUT</span> --}}
                            </div>
                            <div class="TitleFirstPage">
                                <span class="NameProFirstPage">{{ $discountProduct->product_name }}</span>
                                <span class="NameProFirstPageColor capitalize">{{ $product->brand->brand_name }}</span>
                                <div class="fial_price">
                                    <span class="PriceFirstPage">{{ $discountProduct->final_price }}$</span>
                                    @if ($discountProduct->discount_type != '')
                                        <span class="PriceFirstPageoG">{{ $discountProduct->product_price }}$</span>
                                    @endif

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </section>
    @endif
    {{-- is featured --}}
    @if (count($IsFeatureProducts) > 0)
        <section>
            <div class="DivTitle" data-aos="fade-right"><span class="borderButtonSpan">Featured Product</span></div>
            <div class="MainContainerFirstPage">
                @foreach ($IsFeatureProducts as $IsFeatureProduct)
                    <div class="ContainerFirstPage" data-aos="fade-up">
                        <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                            <div class="ImageFirstPage">
                                @if (isset($IsFeatureProduct->images[0]->image) && !empty($IsFeatureProduct->images[0]->image))
                                    <img src="{{ asset('front/images/products/' . $IsFeatureProduct->images[0]->image) }}"
                                        alt="">
                                @else
                                    <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                        alt="">
                                @endif
                                {{-- <span class="soldOutItems">SOLD OUT</span> --}}
                            </div>
                            <div class="TitleFirstPage">
                                <span class="NameProFirstPage">{{ $IsFeatureProduct->product_name }}</span>
                                <span class="NameProFirstPageColor">{{ $IsFeatureProduct->product_color }}</span>
                                <div class="fial_price">
                                    <span class="PriceFirstPage">{{ $IsFeatureProduct->final_price }}$</span>
                                    @if ($IsFeatureProduct->discount_type != '')
                                        <span class="PriceFirstPageoG">{{ $IsFeatureProduct->product_price }}$</span>
                                    @endif

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    <section>
        @include('client.pages.review_comment')
    </section>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                direction: 'horizontal',
                slidesPerView: 4,
                spaceBetween: 30,
                loop: true,
                grabCursor: true,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                on: {
                    touchStart: function() {
                        this.autoplay.stop();
                    },
                    touchEnd: function() {
                        this.autoplay.start();
                    },
                },
            });
        });
    </script>
@endsection
