<?php use App\Models\ProductsFilter;
use App\Models\Category;
$categories = Category::getCategories();
$categoryDeails = Category::categoryDetails($url);
?>

<div class="FilterContainer">
    <div class="TitleFilter">
        <i class="fa-solid fa-filter"></i>
        <span class="fikte">FILTERS</span>
    </div>
    <div class="categoryList">
        <span class="MainMainCate">Category</span>
        <div class="coverCategory">
            @foreach ($categories as $item)
                <li class="dropdown__item">
                    <div class="nav__link">
                        <span class="hover__cate capitalize">
                            {{ $item->category_name }}
                        </span>
                        @if (count($item->subCategories))
                            <i class="fa-solid fa-chevron-down dropdown_arrow"></i>
                        @endif
                    </div>
                    @if (count($item->subCategories))
                        <ul class="dropdown__menu">
                            <li class="dropdown__subitem">
                                @foreach ($item->subCategories as $subitem)
                                    <div class="dropdown__link">
                                        <a href="{{ url($subitem->url) }}" class="filter__text capitalize">
                                            <span class="text__sub">{{ $subitem->category_name }}</span>
                                        </a>
                                        @if (count($subitem->subCategories))
                                            <!-- Check if subitem has sub-categories -->
                                            <i class="fa-solid fa-plus dropdown__add"></i>
                                        @endif
                                    </div>
                                    @if (count($subitem->subCategories))
                                        <ul class="dropdown__submenu">
                                            @foreach ($subitem->subCategories as $subsubitem)
                                                <li>
                                                    <a href="{{ url($subsubitem->url) }}"
                                                        class="capitalize filter__text dropdown__sublink">
                                                        <span
                                                            class="text__sub text__subsub">{{ $subsubitem->category_name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                    @endif
                </li>
            @endforeach
        </div>
    </div>
    {{-- Size --}}
    <?php $getSizes = ProductsFilter::getSizes($categoryDetails->catIds); ?>
    @if ($getSizes && count($getSizes) > 0)
        <div class="categoryList">
            <span class="MainMainCate">Size</span>
            <div class="coverCategory Colors">

                @foreach ($getSizes as $key => $size)
                    <?php
                    if (isset($_GET['size']) && !empty($_GET['size'])) {
                        $sizes = explode('~', $_GET['size']);
                    
                        if (!empty($sizes) && in_array($size, $sizes)) {
                            $sizechecked = 'checked';
                        } else {
                            $sizechecked = '';
                        }
                    } else {
                        $sizechecked = '';
                    }
                    ?>
                    <div class="checkbox-wrapper-1">
                        <input id="size{{ $key }}" class="substituted filterAjax" name="size"
                            value="{{ $size }}" type="checkbox" {{ $sizechecked }} />
                        <label class="labelBrandandSize" for="size{{ $key }}">{{ $size }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Brand --}}
    <?php $getBrands = ProductsFilter::getBrands($categoryDetails->catIds); ?>
    @if ($getBrands && count($getBrands) > 0)
        <div class="categoryList">
            <span class="MainMainCate">Brands</span>
            <div class="coverCategory Colors">
                @foreach ($getBrands as $key => $brand)
                    <?php
                    if (isset($_GET['brand']) && !empty($_GET['brand'])) {
                        $brands = explode('~', $_GET['brand']);
                    
                        if (!empty($brands) && in_array($brand->id, $brands)) {
                            $brandchecked = 'checked';
                        } else {
                            $brandchecked = '';
                        }
                    } else {
                        $brandchecked = '';
                    }
                    ?>
                    <div class="checkbox-wrapper-1">
                        <input id="brand{{ $key }}" class="substituted filterAjax" name="brand"
                            value="{{ $brand->id }}" type="checkbox" {{ $brandchecked }} />
                        <label class="labelBrandandSize"
                            for="brand{{ $key }}">{{ $brand->brand_name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    {{-- Price --}}
    <?php $getPrices = ['0-100', '100-200', '200-300', '300-400', '400-500']; ?>
    @if (count($getPrices) > 0)
        <div class="categoryList">
            <span class="MainMainCate">Price</span>
            <div class="coverCategory Colors">
                @foreach ($getPrices as $key => $price)
                    <?php
                    $pricechecked = ''; // Default value
                    if (isset($_GET['price']) && !empty($_GET['price'])) {
                        $prices = explode('~', $_GET['price']);
                        if (!empty($prices) && in_array($price, $prices)) {
                            $pricechecked = 'checked';
                        }
                    }
                    ?>
                    <div class="checkbox-wrapper-1">
                        <input id="price{{ $key }}" class="substituted filterAjax" name="price"
                            value="{{ $price }}" type="checkbox" {{ $pricechecked }} />
                        <label class=" labelpriceandSize" for="price{{ $key }}"><span
                                class="priceFil">{{ $price }}</span></label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- color --}}
    <?php $getColors = ProductsFilter::getColors($categoryDetails->catIds); ?>
    @if ($getColors && count($getColors) > 0)
        <div class="categoryList">
            <span class="MainMainCate">Color</span>
            <div class="coverCategory Colors">

                @foreach ($getColors as $key => $color)
                    <?php
                    if (isset($_GET['color']) && !empty($_GET['color'])) {
                        $colors = explode('~', $_GET['color']);
                    
                        if (!empty($colors) && in_array($color, $colors)) {
                            $colorchecked = 'checked';
                        } else {
                            $colorchecked = '';
                        }
                    } else {
                        $colorchecked = '';
                    }
                    ?>
                    <div class="checkbox-wrapper-1">
                        <input id="color{{ $key }}" class="substituted filterAjax" name="color"
                            value="{{ $color }}" type="checkbox" {{ $colorchecked }} />
                        <label class="label" for="color{{ $key }}"
                            style="background-color: {{ $color }}" title="{{ $color }}"></label>
                    </div>
                @endforeach


            </div>
        </div>
    @endif

    {{-- Fabric --}}

    <div>
        <?php
        $getDynamicFilters = ProductsFilter::getDynamicFilters($categoryDetails->catIds);
        // dd($getDynamicFilters);
        ?>

        @foreach ($getDynamicFilters as $key => $filter)
            <div class="categoryList">
                <span class="MainMainCate">{{ ucwords($filter) }}</span>
                <div class="coverCategory Colors">
                    <?php
                    // Retrieve filter values for the current filter
                    $filterValues = ProductsFilter::selectedFilters($filter, $categoryDetails->catIds);
                    ?>
                    @foreach ($filterValues as $fkey => $filterValue)
                        <?php
                        $filterValueArray = json_decode($filterValue, true);
                        ?>
                        @php
                            $checkFilter = '';
                        @endphp
                        @if (isset($_GET[$filter]))
                            @php
                                $explodeFilter = explode('~', $_GET[$filter]);
                            @endphp
                            @foreach ($filterValueArray as $key => $value)
                                @if (in_array($value, $explodeFilter))
                                    @php
                                        $checkFilter = 'checked';
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        <div class="checkbox-wrapper-1">
                            <input id="filter{{ $fkey }}" class="substituted filterAjax"
                                name="{{ $filter }}" value="{{ implode('~', $filterValueArray) }}"
                                type="checkbox" {{ $checkFilter }} />
                            <label class="labelpriceandSize" for="filter{{ $fkey }}">
                                <span class="priceFil">
                                    {{ implode(', ', $filterValueArray) }}
                                </span>
                            </label>
                        </div>
                    @endforeach


                </div>
            </div>
        @endforeach
    </div>


</div>
@section('scripts')
    <script>
        // side bar menu filter in age listing
        const openMenuFiler = () => {
            document.querySelector(".backdrop_filter").classList.add("active");

            const sideFilterWrappers = document.getElementsByClassName(
                "side_filter_wrapper"
            );
            for (let i = 0; i < sideFilterWrappers.length; i++) {
                sideFilterWrappers[i].classList.add("visible");
            }
        };

        const closeMenuFilter = () => {
            document.querySelector(".backdrop_filter").classList.remove("active");
            const sideFilterWrappers = document.getElementsByClassName(
                "side_filter_wrapper"
            );
            for (let i = 0; i < sideFilterWrappers.length; i++) {
                sideFilterWrappers[i].classList.remove("visible");
            }
        };

        document.addEventListener("DOMContentLoaded", function() {
            // Your JavaScript code here
            document
                .getElementById("menuBtnFilterListing")
                .addEventListener("click", (e) => {
                    e.preventDefault();
                    openMenuFiler();
                });

            document
                .querySelector(".backdrop_filter")
                .addEventListener("click", (e) => {
                    closeMenuFilter();
                });

            document
                .querySelector(".side_filter_wrapper .closeFilter")
                .addEventListener("click", (e) => {
                    closeMenuFilter();
                });
        });
    </script>
@endsection
