<?php

namespace App\Http\Controllers\admin;

use App\Models\Ratings;
use App\Models\AdminRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RatingController extends Controller
{
    public function rating()
    {
        Session::put('page', 'rating');
        $ratings = Ratings::with(['user', 'product'])->get();
        // permission
        $ratingModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'ratings'])->count();
        $ratingModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $ratingModule['view_access'] = 1;
            $ratingModule['edit_access'] = 1;
            $ratingModule['full_access'] = 1;
        } else if ($ratingModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $ratingModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'ratings'])->first()->toArray();
        }
        return view('admin.ratings.rating')->with(compact('ratings', 'ratingModule'));
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
    public function deleteRating($id)
    {
        Ratings::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Delete success');
    }
}
