<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\NewseltterSubcribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewseltterController extends Controller
{
    public function subscribers()
    {
        Session::put('page', 'subscriber');
        $subscribers = NewseltterSubcribers::get();
        // permission
        $subscribersModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'subscribers'])->count();

        $subscribersModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $subscribersModule['view_access'] = 1;
            $subscribersModule['edit_access'] = 1;
            $subscribersModule['full_access'] = 1;
        } else if ($subscribersModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $subscribersModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'subscribers'])->first()->toArray();
        }
        return view('admin.subscribers.subscribers')->with(compact('subscribers',  'subscribersModule'));
    }

    // update subscribe
    public function updateUserSubscriber(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            NewseltterSubcribers::where('id',  $data['subscriber_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'subscriber_id' => $data['subscriber_id']
            ]);
        }
    }
    // delete
    public function deleteSubscriber($id)
    {
        NewseltterSubcribers::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Delete successfully');
    }
}
