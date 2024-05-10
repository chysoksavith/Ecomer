<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    public function shippingCharges()
    {
        Session::put('page', 'shipping');
        $shippingCharges = ShippingCharges::where(['is_delete' => 1])->get();
        return view('admin.shipping.shipping_list')->with(compact('shippingCharges'));
    }
    public function updateShippingStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            shippingCharges::where('id', $data['shipping_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'shipping_id' => $data['shipping_id']
            ]);
        }
    }
    public function editShipping(Request $request, $id)
    {
        // update
        if ($request->isMethod('post')) {
            $data = $request->all();
            ShippingCharges::where('id', $id)->update([
                '0_500g' => $data['0_500g'],
                '501_1000g' => $data['501_1000g'],
                '1001_2000g' => $data['1001_2000g'],
                '2001_5000g' => $data['2001_5000g'],
                'above_5000g' => $data['above_5000g'],
            ]);
            $message = "Update shipping charge successfully";
            return redirect()->back()->with('success_message', $message);
        }
        // Fetch the shipping charge with the given ID
        $shippingCharges = ShippingCharges::where('id', $id)->first();

        // Check if a shipping charge was found
        if ($shippingCharges) {
            // If a shipping charge was found, load the edit view with the shipping charge data
            return view('admin.shipping.edit_shipping')->with(compact('shippingCharges'));
        } else {
            // If no shipping charge was found, redirect back with an error message
            return redirect()->back()->with('error_message', 'Shipping charge not found with the given ID');
        }
    }
    // delete
    public function deleteShipping(Request $request, $id)
    {
        $shippingDelete = ShippingCharges::find($id);
        if (!empty($shippingDelete)) {
            $shippingDelete->is_delete = 0;
            $shippingDelete->save();
            return redirect()->back()->with('success_message', 'Delete successfully!');
        } else {
            abort(404);
        }
    }
    // delete select
    public function deleteShippingAll(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            $shipDeleteAll = ShippingCharges::whereIn('id', $ids)->get();

            // update each
            foreach ($shipDeleteAll as $shipdelete) {
                $shipdelete->is_delete = 0;
                $shipdelete->save();
            }
            return redirect()->back()->with('success_message', 'Selected records deleted successfully!');
        } else {
            return redirect()->back()->with('error_message', 'No records selected for deletion.');
        }
    }
    // recovery
    public function shippingChargesRecovery()
    {
        $recoveryShip = ShippingCharges::where('is_delete', 0)->get();
        return view('admin.shipping.recover_shipping')->with(compact('recoveryShip'));
    }
    //
    public function recoverDeleteShipping($id)
    {
        $shippingDelete = ShippingCharges::find($id);
        if (!empty($shippingDelete)) {
            $shippingDelete->is_delete = 1;
            $shippingDelete->save();
            return redirect()->back()->with('success_message', 'Delete successfully!');
        } else {
            abort(404);
        }
    }
    public function RecoverydeleteShippingAll(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            $recoveryDelete = ShippingCharges::whereIn('id', $ids)->get();

            // update each
            foreach ($recoveryDelete as $recovery) {
                $recovery->is_delete = 1;
                $recovery->save();
            }
            return redirect()->back()->with('success_message', 'Selected records deleted successfully!');
        } else {
            return redirect()->back()->with('error_message', 'No records selected for deletion.');
        }
    }
}
