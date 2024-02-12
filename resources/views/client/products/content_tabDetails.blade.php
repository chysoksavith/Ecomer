{{-- <div class="contentTavdetails">
    <div class="tab">
        <span class="tablinks StyleTab btnStyleTab" onclick="opanTab(event, 'Description')"
            id="defaultOpen">Description</span>
        <span class="tablinks StyleTab btnStyleTab" onclick="opanTab(event, 'Video')">Video</span>
        <span class="tablinks StyleTab btnStyleTab" onclick="opanTab(event, 'Review')">Review</span>
    </div>

    <div id="Description" class="tabcontent">
        <div class="descriptionContent">
            <span class="titleContent">This is a {{ $productDetails->product_name }}. Very Good of pure cotton </span>
            <div class="productInfo">
                <span class="ProdInfo">Product Information</span>
                <div class="detailPro">
                    <div class="moreDetail">
                        <span class="prodt">Brand</span>
                        <span class="prodt1">{{ $productDetails->brand->brand_name }}</span>
                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        <span class="prodt">Product Code</span>
                        <span class="prodt1">{{ $productDetails->product_code }}</span>
                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        <span class="prodt">Product Color</span>
                        <span class="prodt1">{{ $productDetails->product_color }}</span>
                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        @if (!empty($productDetails->fabric))
                            <span class="prodt">Fabric</span>
                            <span class="prodt1">{{ $productDetails->fabric }}</span>
                        @endif

                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        @if (!empty($productDetails->pattern))
                            <span class="prodt">Pattern</span>
                            <span class="prodt1">{{ $productDetails->pattern }}</span>
                        @endif

                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        @if (!empty($productDetails->fabric))
                            <span class="prodt">Sleeve</span>
                            <span class="prodt1">{{ $productDetails->sleeve }}</span>
                        @endif

                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        @if (!empty($productDetails->fabric))
                            <span class="prodt">Fit</span>
                            <span class="prodt1">{{ $productDetails->fit }}</span>
                        @endif

                    </div>
                </div>

                <div class="detailPro">
                    <div class="moreDetail">
                        @if (!empty($productDetails->occasion))
                            <span class="prodt">Occasion</span>
                            <span class="prodt1">{{ $productDetails->occasion }}</span>
                        @endif

                    </div>
                </div>
                <div class="detailPro">
                    <div class="moreDetail">
                        @if (!empty($productDetails->product_wieght))
                            <span class="prodt">Shipping Wieght (Grams )</span>
                            <span class="prodt1">{{ $productDetails->product_wieght }}</span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="Video" class="tabcontent">
        <div class="videoDetails">
            @if ($productDetails['product_video'])
                <video width="400px" controls>
                    <source src="{{ url('front/videos/' . $productDetails['product_video']) }}" type="Video/mp4">
                    Your browser does not support html video
                </video>
            @else
                Product video does not exitsts
            @endif
        </div>
    </div>

    <div id="Review" class="tabcontent">
        <h3>Tokyo</h3>
        <p>Tokyo is the capital of Japan.</p>
    </div>

</div> --}}
