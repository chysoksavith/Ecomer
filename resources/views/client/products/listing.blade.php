@extends('client.layouts.layout')
@section('content')
    <section class="SectionContain">
        <div class="containerList">
            @if (empty($_GET['query']))
                @include('client.products.filter')
            @else
                @include('client.products.filter-search')
            @endif
            {{--  --}}
            <div class="ListProductContent">

                <div class="productFoundContain">
                    <span class="fountItem">FOUND {{ count($categoryProducts) }} RESULT</span>
                    <div class="btnItem">
                        @if (isset($_GET['query']) && !empty($_GET['query']))
                            {{ $_GET['query'] }}
                        @else
                            <?php echo $categoryDetails->breadCrumb; ?>
                        @endif
                    </div>
                </div>
                @if (empty($_GET['query']))
                    @if ($categoryProducts && count($categoryProducts) > 0)
                        <div class="SortByNewstItem">
                            <div class="filter_dfNone">
                                <div class="Filter_respons">
                                    <span class="LogoAside" id="menuBtnFilterListing">
                                        <img class="logo" src="{{ asset('icons8-menu-50.png') }}" alt="">
                                    </span>
                                    <span class="text__menu">
                                        FILTER
                                    </span>
                                </div>
                            </div>

                            @include('client.products.sidebar_filter')
                            <div class="container">
                                <form action="" name="sortProducts" id="sortProducts">
                                    @csrf
                                    <input type="hidden" name="url" id="url" value="{{ $url }}">
                                    <select name="sort" id="sort" class="getsort select ">
                                        <option class="capitalize" value="">Sort Items</option>
                                        <option class="capitalize" value="product_latest"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'product_latest' ? 'selected' : '' }}>
                                            Sort By: Latest Items
                                        </option>
                                        <option class="capitalize" value="best_selling"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'best_selling' ? 'selected' : '' }}>
                                            Best Selling</option>
                                        <option class="capitalize" value="best_rating"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'best_rating' ? 'selected' : '' }}>
                                            Best Rating</option>
                                        <option class="capitalize" value="lowest_price"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'lowest_price' ? 'selected' : '' }}>
                                            Lowest Price</option>
                                        <option class="capitalize" value="highest_price"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'highest_price' ? 'selected' : '' }}>
                                            Highesh Price</option>
                                        <option class="capitalize" value="featired_items"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'featired_items' ? 'selected' : '' }}>
                                            Featured Items</option>
                                        <option class="capitalize" value="discount_items"
                                            {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == 'discount_items' ? 'selected' : '' }}>
                                            Discoutn iTEMS</option>
                                    </select>
                                </form>

                            </div>
                        </div>
                    @endif
                @endif
                {{-- product --}}
                <div class="MainMainContanerFirstPage" id="appendProducts">
                    @include('client.products.ajax_products_list')
                </div>
            </div>
        </div>


    </section>
@endsection
@section('scripts')
    <script>
        const selectedAll = document.querySelectorAll(".wrapper-dropdown");

        selectedAll.forEach((selected) => {
            const optionsContainer = selected.children[2];
            const optionsList = selected.querySelectorAll("div.wrapper-dropdown li");

            selected.addEventListener("click", () => {
                let arrow = selected.children[1];

                if (selected.classList.contains("active")) {
                    handleDropdown(selected, arrow, false);
                } else {
                    let currentActive = document.querySelector(".wrapper-dropdown.active");

                    if (currentActive) {
                        let anotherArrow = currentActive.children[1];
                        handleDropdown(currentActive, anotherArrow, false);
                    }

                    handleDropdown(selected, arrow, true);
                }
            });

            // update the display of the dropdown
            for (let o of optionsList) {
                o.addEventListener("click", () => {
                    selected.querySelector(".selected-display").innerHTML = o.innerHTML;
                });
            }
        });

        // check if anything else ofther than the dropdown is clicked
        window.addEventListener("click", function(e) {
            if (e.target.closest(".wrapper-dropdown") === null) {
                closeAllDropdowns();
            }
        });

        // close all the dropdowns
        function closeAllDropdowns() {
            const selectedAll = document.querySelectorAll(".wrapper-dropdown");
            selectedAll.forEach((selected) => {
                const optionsContainer = selected.children[2];
                let arrow = selected.children[1];

                handleDropdown(selected, arrow, false);
            });
        }

        // open all the dropdowns
        function handleDropdown(dropdown, arrow, open) {
            if (open) {
                arrow.classList.add("rotated");
                dropdown.classList.add("active");
            } else {
                arrow.classList.remove("rotated");
                dropdown.classList.remove("active");
            }
        }
    </script>
@endsection
