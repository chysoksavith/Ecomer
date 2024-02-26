<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\Country;
use App\Models\DeliveryAddresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // check for delivery address
            $deliveryAddressCount = DeliveryAddresses::where('user_id', Auth::user()->id)->count();

            if ($deliveryAddressCount == 0) {
                return redirect()->back()->with('error_message', "Please add your Delivery Address");
            }

            // check for payment method
            if (empty($data['payment_geteway'])) {
                return redirect()->back()->with('error_message', "Please select your Payment Method");
            }
            if (!isset($data['agree'])) {
                return redirect()->back()->with('error_message', "Please agree to Term of service ");
            }

            echo "proceess order"; die;
        }

        // get country
        $countries = Country::where('status', 1)->get()->toArray();
        // get update cart item
        $getCartItems = getCartItems();
        // Get delivery address of the User
        $deliveryAddress = DeliveryAddresses::deliveryAddresses();
        return view('client.checkout.checkout')->with(compact('getCartItems', 'countries', 'deliveryAddress'));
    }
}
