<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\NewseltterSubcribers;
use Illuminate\Http\Request;

class NewseletterController extends Controller
{
    public function addSubscriber(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $subscriberCount = NewseltterSubcribers::where('email', $data['subscriber_email'])
                ->count();
            if($subscriberCount > 0) {
                return "exists";
            }else{
                // add Newsletter email
                $subscriber = new NewseltterSubcribers;
                $subscriber->email = $data['subscriber_email'];
                $subscriber->status = 1;
                $subscriber->save();
                return "saved";
            }
        }
    }
}
