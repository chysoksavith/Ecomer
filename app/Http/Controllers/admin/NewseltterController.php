<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NewseltterSubcribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewseltterController extends Controller
{
    public function subscribers()
    {
        Session::put('page', 'subscriber');
        $subscribers = NewseltterSubcribers::paginate(4);
        return view('admin.subscribers.subscribers')->with(compact('subscribers'));
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
    public function deleteSubscriber($id){
        NewseltterSubcribers::where('id', $id)->delete();
        return redirect()->back()->with('success_message','Delete successfully');
    }
}
