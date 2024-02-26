<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DeliveryAddresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AddressController extends Controller
{
    public function GetDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $deliveryAddress = DeliveryAddresses::where('id', $data['addressid'])->first()->toArray();
            return response()->json([
                'address' => $deliveryAddress,
            ]);
        }
    }
    public function SaveDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'delivery_name' => 'required|string|max:100',
                'delivery_address' => 'required|string|max:200',
                'delivery_city' => 'required|string|max:100',
                'delivery_state' => 'required|string|max:100',
                'delivery_country' => 'required|string|max:100',
                'delivery_pincode' => 'required|digits:6',
                'delivery_mobile' => 'required|numeric|digits:9',
            ]);
            if ($validator->passes()) {

                $data = $request->all();
                $address = array();
                $address = [
                    'user_id' => Auth::user()->id,
                    'name' => $data['delivery_name'],
                    'address' => $data['delivery_address'],
                    'city' => $data['delivery_city'],
                    'state' => $data['delivery_state'],
                    'country' => $data['delivery_country'],
                    'pincode' => $data['delivery_pincode'],
                    'mobile' => $data['delivery_mobile'],
                    'status' => 1
                ];

                if (!empty($data['delivery_id'])) {
                    // edit delivery address\
                    DeliveryAddresses::where('id', $data['delivery_id'])->update($address);
                } else {
                    // add delivery address
                    DeliveryAddresses::create($address);
                }
                // get update delivery address
                $deliveryAddress = DeliveryAddresses::deliveryAddresses();
                $countries = Country::where('status', 1)->get()->toArray();
                return response()->json([
                    'view' => (string)View::make('client.checkout.delivery_address')->with(compact('deliveryAddress', 'countries'))
                ]);
            } else {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        }
    }
    // delete delivery address
    public function delteDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            DeliveryAddresses::where('id', $data['addressid'])->delete();
            $countries = Country::where('status', 1)->get()->toArray();
            $deliveryAddress = DeliveryAddresses::deliveryAddresses();

            return response()->json([
                'message' => "Delivery address delete successfully",

                'view' => (string)View::make('client.checkout.delivery_address')->with(compact('countries', 'deliveryAddress'))
            ]);
            return response()->json([
                'address' => $deliveryAddress
            ]);
        }
    }
    // set default delivery address
    public function SetDefaultDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            DeliveryAddresses::where('user_id', Auth::user()->id)->update(['is_default' => 0]);
            DeliveryAddresses::where('id', $data['addressid'])->update(['is_default' => 1]);
            $countries = Country::where('status', 1)->get()->toArray();
            $deliveryAddress = DeliveryAddresses::deliveryAddresses();

            return response()->json([
                'view' => (string)View::make('client.checkout.delivery_address')->with(compact('countries', 'deliveryAddress'))
            ]);
            return response()->json([
                'address' => $deliveryAddress
            ]);
        }
    }
}
