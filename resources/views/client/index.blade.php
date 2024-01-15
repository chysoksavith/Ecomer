@extends('client.layouts.layout')
@section('content')
    <section>
        <div class="DivTitle">New Arrivals</div>
        <div class="MainContainerFirstPage">
            @foreach ($NewProducts as $product)
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
    </section>
    <section>
        <div class="bannerIndex">
            @foreach ($homeSliderBanner as $sliderBanner)
                <div class="BannerImage">
                    <img src="{{ asset('front/images/banner/' . $sliderBanner->image) }}" alt="">
                    <div class="divInfBanner">

                        <span class="titleInfo">
                            Now Live
                        </span>
                        <span class="middletextBanner">
                           {{$sliderBanner->title}}
                        </span>

                        <a href="" style="text-decoration: none;">
                            <button type="submit" class="bannerBtn">Discover</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Best Seller Product --}}
    <section>
        <div>Best Seller</div>
        <div class="MainContainerFirstPage">
            @foreach ($BestSeller as $ProductBestSeller)
                <div class="ContainerFirstPage">
                    <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                        <div class="ImageFirstPage">
                            @if (isset($ProductBestSeller->images[0]->image) && !empty($ProductBestSeller->images[0]->image))
                                <img src="{{ asset('front/images/products/' . $ProductBestSeller->images[0]->image) }}"
                                    alt="">
                            @else
                                <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                    alt="">
                            @endif
                            <span class="soldOutItems">SOLD OUT</span>
                        </div>
                        <div class="TitleFirstPage">
                            <span class="NameProFirstPage">{{ $ProductBestSeller->product_name }}</span>
                            <span class="NameProFirstPageColor">{{ $ProductBestSeller->product_color }}</span>
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
    {{-- duscount Product --}}
    <section>
        <div>Discount Product</div>
        <div class="MainContainerFirstPage">
            @foreach ($discountProducts as $discountProduct)
                <div class="ContainerFirstPage">
                    <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">

                        <div class="ImageFirstPage">
                            @if (isset($discountProduct->images[0]->image) && !empty($discountProduct->images[0]->image))
                                <img src="{{ asset('front/images/products/' . $discountProduct->images[0]->image) }}"
                                    alt="">
                            @else
                                <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                    alt="">
                            @endif
                            <span class="soldOutItems">SOLD OUT</span>
                        </div>
                        <div class="TitleFirstPage">
                            <span class="NameProFirstPage">{{ $discountProduct->product_name }}</span>
                            <span class="NameProFirstPageColor">{{ $discountProduct->product_color }}</span>
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
    {{-- is featured --}}
    <section>
        <div>Featured Product</div>
        <div class="MainContainerFirstPage">
            @foreach ($IsFeatureProducts as $IsFeatureProduct)
                <div class="ContainerFirstPage">
                    <a href="{{ url('product/' . $product->id) }}" class="AherfItemProduct">
                        <div class="ImageFirstPage">
                            @if (isset($IsFeatureProduct->images[0]->image) && !empty($IsFeatureProduct->images[0]->image))
                                <img src="{{ asset('front/images/products/' . $IsFeatureProduct->images[0]->image) }}"
                                    alt="">
                            @else
                                <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                                    alt="">
                            @endif
                            <span class="soldOutItems">SOLD OUT</span>
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
@endsection
