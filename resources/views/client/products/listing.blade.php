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
                            <div class="wrapper-dropdown" id="dropdown">
                                <span class="selected-display" id="destination">Sort By: Newest</span>
                                <svg class="arrow" id="drp-arrow" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="transition-all ml-auto rotate-180">
                                    <path d="M7 14.5l5-5 5 5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <ul class="dropdown">
                                    <li class="item">Option 1</li>
                                </ul>
                            </div>

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
                <div class="MainContainerFirstPage">
                    @include('client.products.ajax_products_list')
                </div>
                <div class="containerPaginate">
                    <ul class="pagination">
                        @if ($categoryProducts->currentPage() > 1)
                            <li>
                                <a href="{{ $categoryProducts->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo; Prev</span>
                                </a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $categoryProducts->lastPage(); $i++)
                            <li class="{{ $categoryProducts->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $categoryProducts->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($categoryProducts->currentPage() < $categoryProducts->lastPage())
                            <li>
                                <a href="{{ $categoryProducts->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">Next &raquo;</span>
                                </a>
                            </li>
                        @endif
                    </ul>
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
