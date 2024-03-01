<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\Country;
use App\Models\DeliveryAddresses;
use App\Models\Order_Product;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // get update cart item
        $getCartItems = getCartItems();

        if (count($getCartItems) == 0) {
            $message = "Shopping Cart is empty! Please add Products to Checkout";
            return redirect('cart')->with('error_message', $message);
        }


        if ($request->isMethod('post')) {
            $data = $request->all();

            // check for payment method
            if (empty($data['payment_geteway'])) {
                return redirect()->back()->with('error_message', "Please select your Payment Method");
            }
            if (!isset($data['agree'])) {
                return redirect()->back()->with('error_message', "Please agree to Term of service ");
            }
            // check for delivery address
            $deliveryAddressCount = DeliveryAddresses::where('user_id', Auth::user()->id)
                ->where('is_default', 1)->count();

            if ($deliveryAddressCount == 0) {
                return redirect()->back()->with('error_message', "Please select your Delivery Address");
            } else {
                $deliveryAddress = DeliveryAddresses::where('user_id', Auth::user()->id)
                    ->where('is_default', 1)->first()->toArray();
                // dd($deliveryAddress);
            }

            // Set Payment method as COD and Order status as New if COD is selected from user otherwise Set Payment method as Prepaid and Order status as Pending if COD is selected

            if ($data['payment_geteway'] == "COD") {
                $payment_method = "COD";
                $order_status = "New";
            } else {
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }

            DB::beginTransaction();

            // Fetch Order total price
            $total_price = 0;
            foreach ($getCartItems as $cartItems) {
                $getAttributePrice = Product::getAttributePrice($cartItems['product_id'], $cartItems['product_size']);
                $total_price = $total_price + ($getAttributePrice['final_price'] * $cartItems['product_qty']);
            }

            // Get Shipping charger
            $shipping_charges = 0;

            // Calculate Grand Total
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');

            // Insert Grand Total i Session in Variable
            Session::put('grand_total', $grand_total);

            // Insert Order Details

            $order = new Orders;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->state = $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_geteway'];
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($getCartItems as $Key => $item) {
                $getProductDetails = Product::getProductDetails($item['product_id']);
                $getAttributeDetail = Product::getAttributeDetail($item['product_id'], $item['product_size']);
                $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
                $cartItem = new Order_Product();
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];

                $cartItem->product_size = $item['product_size'];
                $cartItem->product_sku = $getAttributeDetail['sku'];

                $cartItem->product_price = $getAttributePrice['final_price'] * $item['product_qty'];

                $cartItem->product_qty = $item['product_qty'];
                $cartItem->save();
            }
            // inser Order ID in Session variable
            Session::put('order_id', $order_id);
            DB::commit();

            echo "done";
            die;
        }

        // get country
        $countries = Country::where('status', 1)->get()->toArray();

        // Get delivery address of the User
        $deliveryAddress = DeliveryAddresses::deliveryAddresses();
        return view('client.checkout.checkout')->with(compact('getCartItems', 'countries', 'deliveryAddress'));
    }
}
