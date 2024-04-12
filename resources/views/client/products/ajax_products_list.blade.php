@if ($categoryProducts && count($categoryProducts) > 0)
    <div class="MainContainerFirstPage">
        @foreach ($categoryProducts as $product)
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
@else
    No product items
@endif
@if (empty($_GET['query']))
    <div class="pagination">
        <?php
        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '';
        }
        if (!isset($_GET['color'])) {
            $_GET['color'] = '';
        }
        if (!isset($_GET['size'])) {
            $_GET['size'] = '';
        }
        if (!isset($_GET['brand'])) {
            $_GET['brand'] = '';
        }
        if (!isset($_GET['price'])) {
            $_GET['price'] = '';
        }
        if (!isset($_GET['fabric'])) {
            $_GET['fabric'] = '';
        }
        if (!isset($_GET['fit'])) {
            $_GET['fit'] = '';
        }
        if (!isset($_GET['pattern'])) {
            $_GET['pattern'] = '';
        }
        if (!isset($_GET['sleeve'])) {
            $_GET['sleeve'] = '';
        }
        if (!isset($_GET['occasion'])) {
            $_GET['occasion'] = '';
        }
        ?>
        {{ $categoryProducts->appends(
                array_filter([
                    'sort' => $_GET['sort'],
                    'color' => $_GET['color'],
                    'size' => $_GET['size'],
                    'brand' => $_GET['brand'],
                    'price' => $_GET['price'],
                    'fabric' => $_GET['fabric'],
                    'fit' => $_GET['fit'],
                    'pattern' => $_GET['pattern'],
                    'sleeve' => $_GET['sleeve'],
                    'occasion' => $_GET['occasion'],
                ]),
            )->links() }}
    </div>
@endif
