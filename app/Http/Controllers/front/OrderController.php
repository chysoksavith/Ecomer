<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\OrderLog;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function Order()
    {
        $orders = Orders::with('orders_products')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('client.orders.order')->with(compact('orders'));
    }
    public function OrderDetails(Request $request, $id)
    {
        $orderDetails = Orders::with('orders_products', 'user', 'log')->where('id', $id)->first()->toArray();
        return view('client.orders.order_detail')->with(compact('orderDetails'));
    }
    // cancel oprder
    public function cancelOrder(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (isset($data['reason']) && empty($data['reason'])) {
                return redirect()->back();
            }

            // get user id from order
            $user_order_auth = Auth::user()->id;
            // get user id from order
            $user_order_id = Orders::select('user_id')->where('id', $id)->first();
            // if id not matching
            if ($user_order_auth == $user_order_id->user_id) {
                // update order status cancel
                Orders::where('id', $id)->update(['order_status' => 'Cancelled']);
                // update order log
                $log = new OrderLog;
                $log->order_id = $id;
                $log->order_status = "User Cancelled";
                $log->reason = $data['reason'];
                $log->updated_by = "User";
                $log->save();

                $message = "Order has been Cancelled";
                return redirect()->back()->with('success_message', $message);
            } else {
                return redirect('orders')->with('error_message     ', 'Something went wrong');
            }
        }
    }
}
