<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CmsPage;
use App\Models\Country;
use App\Models\DeliveryAddresses;
use App\Models\Order_Product;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductsAttribure;
use App\Models\ShippingCharges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        // get country
        $countries = Country::where('status', 1)->get()->toArray();
        // Get delivery address of the User
        $deliveryAddress = DeliveryAddresses::deliveryAddresses();
        // Fetch Order total price
        $total_price = 0;
        $total_weight = 0;
        foreach ($getCartItems as $cartItems) {

            $getAttributePrice = Product::getAttributePrice($cartItems['product_id'], $cartItems['product_size']);
            $total_price = $total_price + ($getAttributePrice['final_price'] * $cartItems['product_qty']);
            $product_weight = $cartItems['product']['product_weight'] * $cartItems['product_qty'];
            $total_weight = $total_weight + $product_weight;
        }


        // get shipping charge from default country of the user
        $shipping_charges = 0;
        $addressCount = DeliveryAddresses::where(['user_id' => Auth::user()->id, 'is_default' => 1, 'status' => 1])->count();
        if ($addressCount > 0) {
            $defaultDeliveryAddress = DeliveryAddresses::where(['user_id' => Auth::user()->id, 'is_default' => 1, 'status' => 1])->first()->toArray();
            // Calculate shipping charges based on total weight, regardless of quantity
            $shipping_charges = ShippingCharges::getShippingCharges($defaultDeliveryAddress['country'], $total_weight);
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // website security
            foreach ($getCartItems as $item) {
                // Prevent Disable Product Order
                $product_status = Product::getProductStatus($item['product_id']);
                if ($product_status == 0) {

                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of the Product is disable please try again";
                    return redirect('/cart')->with('error_message', $message);
                }
                // prevent sold out product is order
                $getProductStock = ProductsAttribure::productStock($item['product_id'], $item['product_size']);
                if ($getProductStock == 0) {
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of the Product is Sold Out please try again";
                    return redirect('/cart')->with('error_message', $message);
                }
                // Prevent Disable status  Product attribute Order
                $getAttributeStatus = ProductsAttribure::getAttributeStatus($item['product_id'], $item['product_size']);
                if ($getAttributeStatus == 0) {

                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of the Product Attribute is disable please try again";
                    return redirect('/cart')->with('error_message', $message);
                }
            }
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
            } else if ($data['payment_geteway'] == "Bank Transfer" || $data['payment_geteway'] == "Check") {
                $payment_method = "Prepaid";
                $order_status = "Pending";
            } else {
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }


            DB::beginTransaction();

            // get shipping charge
            $shipping_charges = 0;
            // Calculate Grand Total
            $shipping_charges = ShippingCharges::getShippingCharges($deliveryAddress['country'], $total_weight);
            // Insert Grand Total i Session in Variable
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');
            // Insert Order Details
            Session::put('grand_total', $grand_total);
            $order = new Orders;
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

                if ($data['payment_geteway'] == "COD" || $data['payment_geteway'] == "Bank Transfer" || $data['payment_geteway'] == "Check") {
                    // Reduce stock Scripts Start
                    $getProductStock = ProductsAttribure::productStock($item['product_id'], $item['product_size']);
                    $newStock = $getProductStock - $item['product_qty'];
                    ProductsAttribure::where([
                        'product_id' => $item['product_id'],
                        'size' => $item['product_size'],
                    ])->update(['stock' => $newStock]);
                }
            }
            // inser Order ID in Session variable
            Session::put('order_id', $order_id);
            DB::commit();

            if ($data['payment_geteway'] == "COD" || $data['payment_geteway'] == "Bank Transfer" || $data['payment_geteway'] == "Check") {
                // Send order email

                $orderDetails = Orders::with('orders_products', 'user')->where('id', $order_id)->first()->toArray();

                // send order email
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails,
                ];
                Mail::send('email.order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Placed - CamShop');
                });
                // redirect when success checkout
                if ($data['payment_geteway'] == "COD") {
                    return redirect('/thank');
                } else if ($data['payment_geteway'] == "Bank Transfer") {
                    return redirect('/thank?order=bank');
                } else if ($data['payment_geteway'] == "Check") {
                    return redirect('/thank?order=check');
                }
            }
            if ($data['payment_geteway'] == "Paypal") {
                // Paypal - Redirect user to paypal page after saving orders

                return redirect('/paypal');
            } else {
                echo "Prepaid methods coming soon";
                die;
            }
        }

        // echo $total_price;
        // die;
        return view('client.checkout.checkout')->with(compact('shipping_charges', 'getCartItems', 'countries', 'deliveryAddress'));
    }

    // thanks pages
    public function thanks()
    {
        if (Session::has('order_id')) {
            // empty order cart after place order
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('client.checkout.thank');
        } else {
            return redirect('/cart');
        }
    }
}
