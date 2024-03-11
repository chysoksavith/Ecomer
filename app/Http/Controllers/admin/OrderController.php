<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class OrderController extends Controller
{
    public function Order(){
        Session::put('page','order');
        $orders = Orders::with('orders_products', 'user')->orderBy('id', 'Desc')->get()->toArray();
        return view('admin.order.order')->with(compact('orders'));
    }
    public function DetailOrder(Request $request, $id){
        $orderDetails =  Orders::with('orders_products', 'user')->where('id', $id)->first()->toArray();
        return view('admin.order.order_detail')->with(compact('orderDetails'));
    }
}
