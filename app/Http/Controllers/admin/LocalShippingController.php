<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShipLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocalShippingController extends Controller
{
    public function LocalShipping()
    {
        Session::put('page', 'local_ship');
        $localShip = ShipLocal::get();
        return view('admin.localship.localship_list')->with(compact('localShip'));
    }
    public function editLocalShipping(Request $request, $id)
    {
        Session::put('page', 'local_ship');

        if ($request->isMethod('post')) {
            $data = $request->all();
            ShipLocal::where('id', $id)->update([
                'rate' => $data['rate']
            ]);
            $message = "Update local shipping charge successfully";
            return redirect()->back()->with('success_message', $message);
        }
        $localShipEdit = ShipLocal::where('id', $id)->first();
        return view('admin.localship.edit_localship')->with(compact('localShipEdit'));
    }
    public function updateLocalShippingStatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ShipLocal::where('id', $request['localshipping_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'localshipping_id' => $data['localshipping_id']
            ]);
        }
    }
    public function deleteLocalShipping($id)
    {
        ShipLocal::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Delete successfully');
    }
}
