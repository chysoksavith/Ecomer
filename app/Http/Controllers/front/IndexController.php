<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $homeFixBanner = Banners::where('type', 'Fix')
            ->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->get();

        $homeSliderBanner = Banners::where('type', 'Slider')
            ->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->get();
        // get New Arrival Product
        $NewProducts = Product::with('brand', 'images')
            ->where('status', 1)
            ->orderBy('id', 'Desc')
            ->limit(4)
            ->get();
        // get Best seller Product
        $BestSeller = Product::with('brand', 'images')
            ->where(['is_bestseller' => 'Yes', 'status' => 1])
            ->inRandomOrder()
            ->limit(4)
            ->get();
        // get is featured
        $IsFeatureProducts = Product::with('brand', 'images')
            ->where(['is_featured' => 'Yes', 'status' => 1])
            ->inRandomOrder()
            ->limit(4)
            ->get();
        // get discount product
        $discountProducts = Product::with('brand', 'images')
            ->where('product_discount', '>', 0)
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        // stock
        return view('client.index')->with(compact('homeSliderBanner', 'homeFixBanner', 'NewProducts', 'BestSeller', 'discountProducts', 'IsFeatureProducts'));
    }
    public function HomePage()
    {
        return view('client.pages.homePage');
    }
}
