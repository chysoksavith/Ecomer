<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
                ->where('status', 1)
                ->orderBy('id', 'Desc')
                ->paginate(1);
            return view('client.products.listing')->with(compact('categoryProducts', 'categoryDetails'));
        } else {
            abort(404);
        }
    }
}
