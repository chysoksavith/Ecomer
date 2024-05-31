<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductsAttribure;
use App\Models\ProductsFilter;
use App\Models\Ratings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Nette\Utils\Strings;

use function PHPUnit\Framework\returnSelf;

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
            foreach ($filterType as $Key => $filter) {
                if ($request->$filter) {
                    $explodeFilterVals = explode('~', $request->$filter);
                    $categoryProducts->whereIn($filter, $explodeFilterVals);
                }
            }
            $categoryProducts = $categoryProducts->paginate(10);
            if ($request->ajax()) {
                return response()->json([
                    'view' => (string)View::make('client.products.ajax_products_list')->with(compact('categoryProducts', 'categoryDetails', 'url'))
                ]);
            } else {
                return view('client.products.listing')->with(compact('categoryProducts', 'categoryDetails', 'url'));
            }
        } else if ($request->filled('query')) {
            $search = $request->input('query');
            $categoryDetails['categoryDetails']['category_name'] = $search;
            $categoryProducts = Product::with(['brand', 'images'])
                ->where(function ($query) use ($search) {
                    $query->where('product_name', 'like', '%' . $search . '%')
                        ->orWhere('product_code', 'like', '%' . $search . '%')
                        ->orWhere('product_color', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->where('status', 1)
                ->get();
            return view('client.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
        } else {
            abort(404);
        }
    }
    // live search
    public function liveSearch(Request $request)
    {
        $output = '';
        if ($request->ajax()) {
            $products = Product::where('product_name', 'like', '%' . $request->search . '%')

                ->get();
            if ($products->isNotEmpty()) {
                foreach ($products as $product) {
                    $output .= '
                    <a href="'.url('product/' . $product->id).'" class="a__live">
                        <div class="box__searchProd">
                            <span class="image__live">
                                <img src="' . asset('front/images/products/' . $product->images[0]->image) . '" alt="no image">
                            </span>
                        </div>
                            <div class="price__main">
                                <span class="name__live">
                                ' . $product->product_name . '
                                </span>
                                <span class="price__live">
                                ' . $product->product_price . ' $
                                </span>
                            </div>
                    </a>
                    ';
                }
            } else {
                $output = '<p class="no__product">No products found.</p>';
            }
            return response()->json($output);
        }
    }
    // product detail
    public function detail(Request $request, $id)
    {
        $productCount = Product::where('status', 1)->where('id', $id)->count();
        if ($productCount == 0) {
            abort(404);
        }
        $productDetails = Product::with(['category', 'brand', 'images', 'attributes' => function ($query) {
            $query->where('stock', '>', 0)->where('status', 1);
        }])->find($id);
        // totalStock
        $totalStock = ProductsAttribure::where('product_id', $id)->sum('stock');
        // get category url
        $categoryDetails = Category::categoryDetails($productDetails->category->url);
        // get group code (Product color)
        if (!empty($productDetails['group_code'])) {
            $groupProducts = Product::with('images')->select('id',  'family_color')
                ->where('id', '!=', $id)
                ->where('group_code', $productDetails['group_code'])
                ->where('status', 1)
                ->get();
        }
        // get product related
        $relatedProducts = Product::with('brand', 'images')
            ->where('category_id', $productDetails['category_id'])
            ->where('id', '!=', $id)
            ->limit(4)
            ->inRandomOrder()
            ->get();

        // get Rating

        $rating = Ratings::with('user', 'product')->where(['product_id' => $id, 'status' => 1])->paginate(10);

        // get average rating of product
        $ratingSum = Ratings::where(['product_id' => $id, 'status' => 1])->sum('rating');
        $ratingCount = Ratings::where(['product_id' => $id, 'status' => 1])->count();
        $avgRating = null; // Initialize $avgRating to null
        $avgStartRating = null; // Initialize $avgStartRating to null

        if ($ratingCount > 0) {
            $avgRating = round($ratingSum / $ratingCount, 2);
            $avgStartRating = round($ratingSum / $ratingCount);
        }
        // Set session for recently view items
        if (!Session::has('session_id')) {
            $session_id = md5(uniqid(rand(), true));
            Session::put('session_id', $session_id);
        } else {
            $session_id = Session::get('session_id');
        }

        $countRecentlyViewedItems = DB::table('recently_viewed_items')
            ->where(['product_id' => $id, 'session_id' => $session_id])
            ->count();

        if ($countRecentlyViewedItems == 0) {
            DB::table('recently_viewed_items')->insert(['product_id' => $id, 'session_id' => $session_id]);
        }

        $recentProductIds = DB::table('recently_viewed_items')
            ->select('product_id')
            ->where('product_id', '!=', $id)
            ->where('session_id', $session_id)
            ->inRandomOrder()
            ->get()
            ->take(4)
            ->pluck('product_id');

        $recentProducts = Product::with('brand', 'images')
            ->whereIn('id', $recentProductIds)
            ->get();

        return view('client.products.details')->with(compact('productDetails', 'categoryDetails', 'groupProducts', 'relatedProducts', 'recentProducts', 'rating', 'avgRating', 'avgStartRating', 'totalStock'));
    }
    // get attr price
    public function getAttrPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getAttributePrice = Product::getAttributePrice($data['product_id'], $data['size']);
            return $getAttributePrice;
        }
    }
    // add to cart
    public function AddtoCarts(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            $message = "Please login before adding items to the cart.";
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Forgot session coupon
            Session::forget('couponAmount');
            Session::forget('couponCode');

            // check product stock
            $productStock = ProductsAttribure::productStock($data['product_id'], $data['size']);
            if ($data['qty'] > $productStock) {
                $message = "Required Quantity is not available";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ]);
            }

            // check product Status
            $productStatus = Product::productStatus($data['product_id']);
            if ($productStatus == 0) {
                $message = "Product is not available";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ]);
            }

            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            } else {
                $session_id = Session::get('session_id');
            }

            // check product if already exists in the user cart like user already added it
            $user_id = Auth::user()->id;
            $countProducts = Cart::where(['product_id' => $data['product_id'], 'product_size' => $data['size'], 'user_id' =>  $user_id])->count();

            if ($countProducts > 0) {
                $message = "Product Already in Cart!";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ]);
            }

            // Save product in cart
            $item = new Cart;
            $item->session_id = $session_id;
            $item->user_id = $user_id;
            $item->product_id = $data['product_id'];
            $item->product_size = $data['size'];
            $item->product_qty = $data['qty'];
            $item->save();

            // get total cart item
            $totalCartItems = totalCartItems();
            $getCartItems = getCartItems();
            $message = "Product Added successfully in Cart!";
            return response()->json([
                'status' => true,
                'message' => $message,
                'totalCartItems' => $totalCartItems,
                'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
            ]);
        }
    }

    // public function AddtoCarts(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //         $data = $request->all();

    //         // check product stock
    //         $productStock = ProductsAttribure::productStock($data['product_id'], $data['size']);
    //         if ($data['qty'] > $productStock) {
    //             $message = "Required Quantity is not available";
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => $message
    //             ]);
    //         }
    //         // check product Status
    //         $productStatus = Product::productStatus($data['product_id']);
    //         if ($productStatus == 0) {
    //             $message = "Product is not available";
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => $message
    //             ]);
    //         }

    //         $session_id = Session::get('session_id');
    //         if (empty($session_id)) {
    //             $session_id = Session::getId();
    //             Session::put('session_id', $session_id); // Corrected the typo here
    //         } else {
    //             $session_id = Session::get('session_id');
    //         }
    //         // check product if already exists in the user cart like user already add it
    //         if (Auth::check()) {
    //             // User is login
    //             $user_id = Auth::user()->id;
    //             $countProducts = Cart::where(['product_id' => $data['product_id'], 'product_size' => $data['size'], 'user_id' =>  $user_id])
    //                 ->count();
    //         } else {
    //             // user is not login
    //             $user_id = 0;
    //             $countProducts = Cart::where(['product_id' => $data['product_id'], 'product_size' => $data['size'], 'session_id' =>  $session_id])
    //                 ->count();
    //         }

    //         if ($countProducts > 0) {
    //             $message = "Product Already in Cart!";
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => $message
    //             ]);
    //         }

    //         // Save product in cart
    //         $item = new Cart;
    //         $item->session_id = $session_id;
    //         if (Auth::check()) {
    //             $item->user_id = Auth::user()->id;
    //         }
    //         $item->product_id = $data['product_id'];
    //         $item->product_size = $data['size'];
    //         $item->product_qty = $data['qty'];
    //         $item->save();

    //         // get total cart item
    //         $totalCartItems = totalCartItems();
    //         $getCartItems = getCartItems();
    //         $message = "Product Added successfully in Cart!";
    //         return response()->json([
    //             'status' => true,
    //             'message' => $message,
    //             'totalCartItems' => $totalCartItems,
    //             'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
    //         ]);
    //     }
    // }
    // shopping cart

    public function cart()
    {
        $getCartItems = getCartItems();

        return view('client.products.cart')->with(compact('getCartItems'));
    }
    public function updateCartQty(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Forgot session coupon
            Session::forget('couponAmount');
            Session::forget('couponCode');
            $cartDetails = Cart::find($data['cartid']);
            $availableStock = ProductsAttribure::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['product_size']])->first()->toArray();



            // check if desize stock item from user is available
            if ($data['qty'] > $availableStock['stock']) {
                $getCartItems = getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Quantity exceeds available stock',
                    'view' => (string) View::make('client.products.cart_item')->with(compact('getCartItems')),
                    'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
                ]);
            }
            // check product size
            $availableSize = ProductsAttribure::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['product_size'], 'status' => 1])->count();
            if ($availableSize == 0) {
                $getCartItems = getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product size not available. please the remove and choese another one',
                    'view' => (string) View::make('client.products.cart_item')->with(compact('getCartItems')),
                    'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
                ]);
            }

            // update the cart item qty
            Cart::where('id', $data['cartid'])->update(['product_qty' => $data['qty']]);

            $getCartItems = getCartItems();
            // get total cart item
            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true,
                'totalCartItems' => $totalCartItems,
                'view' => (string) View::make('client.products.cart_item')->with(compact('getCartItems')),
                'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
            ]);
        }
    }

    // delete cart
    public function deleteCart(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->all();
            // Forgot session coupon
            Session::forget('couponAmount');
            Session::forget('couponCode');
            Cart::where('id', $data['cartid'])->delete();
            $getCartItems = getCartItems();

            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true,
                'message' =>  'delete success',
                'totalCartItems' => $totalCartItems,
                'view' => (string) View::make('client.products.cart_item')->with(compact('getCartItems')),
                'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
            ]);
        }
    }
    // delete cart
    public function emptyCart(Request $request)
    {
        if ($request->ajax()) {
            // Call the function to empty the cart
            emptyCart();

            // Retrieve updated cart items and total items count
            $getCartItems = getCartItems();
            $totalCartItems = totalCartItems();

            return response()->json([
                'status' => true,
                'message' => 'Cart emptied successfully',
                'totalCartItems' => $totalCartItems,
                'view' => (string) View::make('client.products.cart_item')->with(compact('getCartItems')),
                'miniCartview' => (string) View::make('client.layouts.Header_smallCart')->with(compact('getCartItems')),
                'detailPageView' => (string) View::make('client.products.details')->with(compact('getCartItems'))

            ]);
        }
        return response()->json([
            'status' => false,
            'emptied' => false,
            'message' => 'No items to Empty.',
        ]);
    }

    // applyCoupon
    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            // get total cart and items
            $getCartItems = getCartItems();
            $totalCartItems = totalCartItems();

            // verify coupon is valid or not
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                return response()->json([
                    'status' => false,
                    'totalCartItems' => $totalCartItems,
                    'message' => 'The Coupon is not Valid',
                    'view' => (string)View::make('client.products.cart_item')->with(compact('getCartItems')),
                    'miniCartView' => (string)View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
                ]);
            } else {
                // Check for condition if it fine

                // Get Coupon details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                // if coupon is inactive
                if ($couponDetails->status == 0) {
                    $error_message = "The Coupon is not active";
                } else {
                }
                // if coupon is expired
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    $error_message = "The Coupon is expired";
                }
                // Check coupon if for single time
                if ($couponDetails->coupon_type == "Single Time") {
                    // check in orders table if coupon already availed by the user
                    $couponCount = Orders::where(['coupon_code' => $data['code'], 'user_id' => Auth::user()->id])->count();
                    if ($couponCount >= 1) {
                        $error_message = "Coupon Code is already used!";
                    }
                }
                // get all selected category from coupon
                $catArr = explode(",", $couponDetails->categories);
                // get all selected brand from coupon
                $brandsArr = explode(",", $couponDetails->brands);
                // get all selected Users from coupon
                $usersArr = explode(",", $couponDetails->users);
                $userID = []; // Initialize an array to store user IDs

                foreach ($usersArr as $user) {
                    $getUserId = User::select('id')->where('email', $user)->first();
                    if ($getUserId) {
                        $userID[] = $getUserId->id; // Store user ID if found
                    }
                }
                // Check if any cart item does not belong to coupon category and Brands and Users than show error message

                $total_amount = 0;
                foreach ($getCartItems as $key => $item) {
                    // Check if any cart item does not belong to coupon category
                    if (!in_array($item['product']['category_id'], $catArr)) {
                        $error_message = "The coupon code is not applicable to one or more selected products.";
                    }
                    // Check if any cart item does not belong to coupon Brands
                    if (!in_array($item['product']['brand_id'], $brandsArr)) {
                        $error_message = "The coupon code is not applicable to one or more selected products.";
                    }
                    // Check if any cart item does not belong to coupon Users
                    if (count($userID) > 0 && !in_array($item['user_id'], $userID)) {
                        $error_message = "This coupon code is not for you. Try again with valid code!";
                        break; // Break the loop if an invalid user is found
                    }
                    $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
                    $total_amount = $total_amount + ($getAttributePrice['final_price'] * $item['product_qty']);
                }




                // if error message is there
                if (isset($error_message)) {
                    return response()->json([
                        'status' => false,
                        'totalCartItems' => $totalCartItems,
                        'message' => $error_message,
                        'view' => (string)View::make('client.products.cart_item')->with(compact('getCartItems')),
                        'miniCartView' => (string)View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
                    ]);
                } else {
                    // Apply if Coupon code is correct

                    // Check if coupon amount type is fixed or percentage
                    if ($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }

                    $grand_total = $total_amount - $couponAmount;

                    // Add Coupon code & amount in session variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon Code is successfully apply";
                    return response()->json([
                        'status' => true,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grandTotal' => $grand_total,
                        'message' => $message,
                        'view' => (string)View::make('client.products.cart_item')->with(compact('getCartItems')),
                        'miniCartView' => (string)View::make('client.layouts.Header_smallCart')->with(compact('getCartItems'))
                    ]);
                }
            }
        }
    }
}
