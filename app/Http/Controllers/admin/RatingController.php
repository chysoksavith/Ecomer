<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ratings;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rating()
    {
        $ratings = Ratings::with(['user', 'product'])->paginate(10);
        return view('admin.ratings.rating')->with(compact('ratings'));
    }
    public function updateUserRating(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Ratings::where('id',  $data['rating_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'rating_id' => $data['rating_id']
            ]);
        }
    }
    public function deleteRating($id){
        Ratings::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Delete success');
    }
}
