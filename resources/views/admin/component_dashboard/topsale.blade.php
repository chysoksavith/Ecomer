@php
    use App\Models\Product;
@endphp
<div class="card col-6">
    <div class="card-header">
        <h3 class="card-title">Top Sale</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach ($topSaleItems as $top)
                <li class="item">
                    <div class="product-img">
                        @php
                            $getProductImage = Product::getProductImage($top['product_id']);
                        @endphp
                        <img src="{{ asset('front/images/products/' . $getProductImage) }}" alt="Product Image"
                            class="img-size-50">
                    </div>
                    <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{ $top->product_name }}
                            <span class="badge badge-warning float-right">${{ $top->product_price }}</span>
                        </a>
                        <span class="product-description">
                            Code: {{ $top->product_code }}
                        </span>
                    </div>
                </li>
            @endforeach

            <!-- /.item -->
        </ul>
    </div>
</div>
