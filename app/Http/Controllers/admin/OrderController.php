<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderLog;
use App\Models\Orders;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class OrderController extends Controller
{
    public function Order()
    {
        Session::put('page', 'order');
        $orders = Orders::with('orders_products', 'user')->orderBy('id', 'Desc')->get()->toArray();
        return view('admin.order.order')->with(compact('orders'));
    }
    public function DetailOrder(Request $request, $id)
    {
        $orderDetails =  Orders::with('orders_products', 'user')->where('id', $id)->first()->toArray();
        // fetch order status
        $orderStatues = OrderStatus::where('status', 1)->get()->toArray();
        // fetch order log
        $orderLog = OrderLog::Where('order_id', $id)->get()->toArray();
        return view('admin.order.order_detail')->with(compact('orderDetails', 'orderStatues', 'orderLog'));
    }
    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // update order status
            Orders::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            // update courier name and tracking number
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Orders::where('id', $data['order_id'])->update([
                    'courier_name' => $data['courier_name'],
                    'tracking_number' => $data['tracking_number']
                ]);

                // Send Order shipped email to customer tracking details
                $orderDetails = Orders::with('orders_products', 'user')->where('id', $data['order_id'])->first()->toArray();
                // Send order shipped email
                $email =  $orderDetails['user']['email'];
                $messageData = [
                    'email' => $email,
                    'name' =>  $orderDetails['user']['name'],
                    'order_id' => $data['order_id'],
                    'order_status' => $data['order_status'],
                    'tracking_number' => $data['tracking_number'],
                    'courier_name' => $data['courier_name'],
                    'orderDetails' => $orderDetails,
                ];
                Mail::send('email.shipped_order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Shipped');
                });
            }
            // update order log
            $log = new OrderLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();




            $message = "Order status has been updated successfully ";
            return redirect()->back()->with('success_message', $message);
        }
    }
    // print invoice
    public function printHtmlOrderInvoice($order_id)
    {
        $orderDetails = Orders::with('orders_products','user')->where('id', $order_id)->first()->toArray();
        return view('admin.order.print-html-order-invoice')->with(compact('orderDetails'));
    }
}
