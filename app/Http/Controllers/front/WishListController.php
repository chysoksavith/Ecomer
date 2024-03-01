<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;

class WishListController extends Controller
{
    public function updateWishList(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $countWishList = Wishlist::countWishList($data['product_id']);

            if ($countWishList == 0) {
                // add product to user's wishlist
                $wishlist = new Wishlist;
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $data['product_id'];
                $wishlist->save();

                return response()->json([
                    'state' => 'add',
                    'message' => 'Product added to wishlist'
                ]);
            } else {
                // remove product from wishlist
                Wishlist::where(['user_id' => Auth::user()->id, 'product_id' => $data['product_id']])->delete();

                return response()->json([
                    'state' => 'remove',
                    'message' => 'Product removed from wishlist'
                ]);
            }
        }
    }

    // wishlist
    public function WishList(Request $request)
    {
        if (Auth::check()) {
            $userWishlistItem = Wishlist::userWishlistItem();
        } else {
            $userWishlistItem = [];
        }

        return view('client.products.wishlist_item')->with(compact('userWishlistItem'));
    }
    // delete
    public function deleteWishList(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Wishlist::where('id', $data['wishlist_id'])->delete();
            $userWishlistItem = Wishlist::userWishlistItem();
            return response()->json([
                'message' => 'Delete Wishlist Item successfully!',
                'View' => (string)View::make('client.products.wishlist_item')->with(compact('userWishlistItem'))
            ]);
        }
    }
}
