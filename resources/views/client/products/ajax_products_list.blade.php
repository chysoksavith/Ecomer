@foreach ($categoryProducts as $product)
    <div class="ContainerFirstPage">
        <a href="#" class="AherfItemProduct">
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
