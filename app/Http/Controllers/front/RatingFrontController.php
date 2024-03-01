<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class RatingFrontController extends Controller
{

    public function addRating(Request $request)
    {
        if (!Auth::check()) {
            $message = "Login to rate this product";
            return response()->json([
                'success' => false,
                'message' => $message,
            ]);
        }

        if ($request->ajax()) {
            $data = $request->all();
            $user_id = Auth::user()->id;

            $ratingCount = Ratings::where(['user_id' => $user_id, 'product_id' => $data['product_id']])
                ->count();

            if ($ratingCount > 0) {
                $message = "Your rating already exists";
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ]);
            }

            $rating = new Ratings;
            $rating->user_id = $user_id;
            $rating->product_id = $data['product_id'];
            $rating->review = $data['review'];
            $rating->rating = $data['rating'];
            $rating->save();

            $message = "Thanks for rating this product!";


            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }
    }
}
