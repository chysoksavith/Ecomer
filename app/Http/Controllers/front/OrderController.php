<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
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
}
