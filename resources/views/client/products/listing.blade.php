@extends('client.layouts.layout')
@section('content')
    <section class="SectionContain">
        <div class="containerList">
            @include('client.products.filter')
            {{--  --}}
            <div class="ListProductContent">
                <div class="SortByNewstItem">
                    <div class="center">
                        <div class="container">
                            <form action="" name="sortProducts" id="sortProducts">
                                @csrf
                                <input type="hidden" name="url" id="url" value="{{{$url}}}">
                                <select name="sort" id="sort" class="getsort">
                                    <option value="">Sort Items</option>
                                    <option value="product_latest" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "product_latest" ? 'selected' : '' }}>
                                        Sort By: Latest Items
                                    </option>
                                    <option value="best_selling" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "best_selling" ? 'selected' : '' }}>Best Selling</option>
                                    <option value="best_rating" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "best_rating" ? 'selected' : '' }}>Best Rating</option>
                                    <option value="lowest_price" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "lowest_price" ? 'selected' : '' }}>Lowest Price</option>
                                    <option value="highest_price" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "highest_price" ? 'selected' : '' }}>Highesh Price</option>
                                    <option value="featired_items" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "featired_items" ? 'selected' : '' }}>Featured Items</option>
                                    <option value="discount_items" {{ isset($_GET['sort']) && !empty($_GET['sort']) && $_GET['sort'] == "discount_items" ? 'selected' : '' }}>Discoutn iTEMS</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="productFoundContain">
                    <span class="fountItem">FOUNT {{ count($categoryProducts) }} RESULT</span>
                    <div class="btnItem">
                        <?php echo $categoryDetails->breadCrumb; ?>
                        {{-- <a href="">Shirt</a> --}}
                    </div>
                </div>

                {{-- product --}}
                <div class="MainMainContanerFirstPage" id="appendProducts" >
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
