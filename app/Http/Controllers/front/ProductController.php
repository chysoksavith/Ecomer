<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        $url = $request->path(); // Get the URL from the request

        $category = Category::where(['url' => $url, 'status' => 1])->count();

        if ($category > 0) {
            // echo "Category";
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);

            // get category and subcategory
            $categoryProducts = Product::with('brand', 'images')
                ->whereIn('category_id', $categoryDetails->catIds)
                ->where('products.status', 1);
            // Update Query for product sorting
            if (isset($request['sort']) && !empty($request['sort'])) {
                if ($request['sort'] == "product_latest") {
                    $categoryProducts->orderBy('id', 'Desc');
                    //
                } else if ($request['sort'] == "lowest_price") {
                    $categoryProducts->orderBy('final_price', 'ASC');
                    //
                } else if ($request['sort'] == "highest_price") {
                    $categoryProducts->orderBy('final_price', 'DESC');
                    //
                } else if ($request['sort'] == "best_selling") {
                    $categoryProducts->where('is_bestseller', 'YES');
                    //
                } else if ($request['sort'] == "featired_items") {
                    $categoryProducts->where('is_featured', 'YES');
                    //
                } else if ($request['sort'] == "discount_items") {
                    $categoryProducts->where('product_discount', '>', 0);
                    //
                } else {
                    $categoryProducts->orderBy('products.id', 'DESC');
                }
            }
            // update Color
            if (isset($request['color']) && !empty($request['color'])) {
                $colors = explode('~', $request['color']);
                $categoryProducts->whereIn('products.family_color', $colors);
            }
            // update Sizes
            if (isset($request['size']) && !empty($request['size'])) {
                $sizes = explode('~', $request['size']);
                $categoryProducts->join('products_attributes', 'products_attributes.product_id', '=', 'products.id')
                    ->whereIn('products_attributes.size', $sizes)
                    ->groupBy('products_attributes.product_id');
            }
            // update query brands
            if (isset($request['brand']) && !empty($request['brand'])) {
                $brands = explode('~', $request['brand']);
                $categoryProducts->whereIn('products.brand_id', $brands);
            }
            // update query Price
            if (isset($request['price']) && !empty($request['price'])) {
                $request['price'] = str_replace("~", "-", $request['price']);
                $prices = explode('-', $request['price']);
                $count = count($prices);

                if ($count >= 2) {
                    $categoryProducts->whereBetween('products.final_price', [$prices[0], $prices[$count - 1]]);
                }
            }
            // update query fabric dynamic product
            $filterType = ProductsFilter::filterType();
            foreach($filterType as $Key => $filter){
                if($request->$filter){
                    $explodeFilterVals = explode('~', $request->$filter);
                    $categoryProducts->whereIn($filter,$explodeFilterVals);
                }
            }
            $categoryProducts = $categoryProducts->paginate(3);
            if ($request->ajax()) {
                return response()->json([
                    'view' => (string)View::make('client.products.ajax_products_list')->with(compact('categoryProducts', 'categoryDetails', 'url'))
                ]);
            } else {
                return view('client.products.listing')->with(compact('categoryProducts', 'categoryDetails', 'url'));
            }
        } else {
            abort(404);
        }
    }
}
