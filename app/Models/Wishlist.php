<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = "wishlists";

    public static function countWishList($product_id)
    {
        if (Auth::check()) {
            $countWishList = Wishlist::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->count();
            return $countWishList;
        } else {
            return 0; // Return 0 if user is not authenticated
        }
    }


    public static function userWishlistItem()
    {
        $userWishlistItem = Wishlist::with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
        return $userWishlistItem;
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('brand', 'images');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
