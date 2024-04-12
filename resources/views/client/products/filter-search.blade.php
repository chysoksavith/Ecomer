<?php
use App\Models\Category;
$categories = Category::getCategories();
?>
<div class="FilterContainer">
    <div class="TitleFilter">
        <i class="fa-solid fa-filter"></i>
        <span class="fikte">FILTERS</span>
    </div>

    <div class="categoryList">
        <span class="MainMainCate">Category</span>
        <div class="coverCategory">
            @foreach ($categories as $category)
                <details>
                    <summary><span class="MainCateTtiek">
                            <a href="javascript:;" class="textDecorA capitalize">{{ $category->category_name }}</a></span>
                    </summary>
                    @if (count($category->subCategories))
                        <details>
                            @foreach ($category->subCategories as $subcategory)
                                <summary class="TitleSubFilter">
                                    <a href="{{ url($subcategory->url) }}" class="textDecorAb capitalize">
                                        {{ $subcategory->category_name }}</a>
                                </summary>
                                @if (count($subcategory->subCategories))
                                    @foreach ($subcategory->subCategories as $subsubcategory)
                                        <p class="subsubCategoryTtile">
                                            <a href="{{ url($subsubcategory->url) }}" class="textDecorAb capitalize">
                                                {{ $subsubcategory->category_name }}</a>
                                        </p>
                                    @endforeach
                                @endif
                            @endforeach

                        </details>
                    @endif
                </details>
            @endforeach

        </div>
    </div>
</div>
