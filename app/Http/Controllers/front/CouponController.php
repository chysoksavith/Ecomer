<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCoupons()
    {
        // Find the currently active coupon, if any
        $existingCoupon = Coupon::where('status', '1')->first();

        // Check if there's a new coupon available
        $newCoupon = Coupon::where('status', '1')->where('id', '>', $existingCoupon->id)->first();

        if ($newCoupon) {
            // If a new coupon is available, update the existing coupon with the new one
            $existingCoupon->update(['status' => '0']); // Deactivate the existing coupon
            $couponCode = $newCoupon->coupon_code;
        } else {
            // If no new coupon is available, use the existing coupon
            $couponCode = $existingCoupon->coupon_code;
        }

        return response()->json([
            'hasCoupon' => true,
            'couponCode' => $couponCode
        ]);
    }
}
