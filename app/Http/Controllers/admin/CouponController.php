<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function coupon()
    {
        Session::put('page', 'coupons');
        $coupons = Coupon::paginate(10);

        // setPermission for coupons
        $couponsModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()
            ->id, 'module' => 'coupons'])->count();
        $couponsModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $couponsModule['view_access'] = 1;
            $couponsModule['edit_access'] = 1;
            $couponsModule['full_access'] = 1;
        } else if ($couponsModuleCount == 0) {
            $message = "this feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $couponsModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'coupons'])->first()->toArray();
        }
        return view('admin.coupons.coupon')->with(compact('coupons', 'couponsModule'));
    }

    // add edit coupon
    public function AddEditCoupon(Request $request, $id = null)
    {
        if ($id == "") {  // Corrected the condition
            // add coupon
            $coupon = new Coupon;
            $selCats = array();
            $selUsers = array();
            $selBrands = array();
            $title = "Add Coupon";
            $message = "Coupon added successfully";
        } else {
            $coupon  = Coupon::find($id);
            $title = "Edit Coupon";
            $selCats = explode(",", $coupon['categories']);
            $selUsers = explode(",", $coupon['users']);
            $selBrands = explode(",", $coupon['brands']);
            $message = "Coupon updated successfully";  // Corrected the message
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo  "<pre>";
            // print_r($data);
            // die;

            $rules = [
                'categories' => 'required',
                'brands' => 'required',
                'coupon_options' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required|numeric',
                'expiry_date' => 'required',
                'coupon_code' => 'unique:coupon,coupon_code,' . $id
            ];


            $customMessages = [
                'categories.required' => 'Select Category',
                'brands.required' => 'Select Brands',
                'coupon_options.required' => 'Select Coupon Option',
                'coupon_type.required' => 'Select Coupon Type',
                'amount_type.required' => 'Select Amount Type',
                'amount.required' => 'Enter Amount',
                'amount.numeric' => 'Amount must be numeric',
                'expiry_date.required' => 'Enter Expiry Date',
            ];

            $this->validate($request, $rules, $customMessages);

            // Covert category array to string
            if (isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            } else {
                $categories = "";
            }
            // Covert Brands array to string
            if (isset($data['brands'])) {
                $brands = implode(',', $data['brands']);
            } else {
                $brands = "";
            }
            // Covert User array to string
            if (isset($data['users'])) {
                $users = implode(',', $data['users']);
            } else {
                $users = "";
            }
            // random coupon when use automatic
            if ($data['coupon_options'] == "Automatic") {
                $coupon_code = Str::random(8);
            } else {
                $coupon_code = $data['coupon_code'];
            }

            $coupon->coupon_options = $data['coupon_options'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories =  $categories;
            $coupon->brands =  $brands;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();

            return redirect('admin/coupons')->with('success_message', $message);
        }

        $getCategories = Category::getCategories();
        $getBrands = Brand::where('status', 1)->get()->toArray();
        $getUsers = User::select('email')->where('status', 1)->get()->toArray();;
        return view('admin.coupons.add_edit_coupon')->with(compact('title', 'coupon', 'getCategories', 'getBrands', 'getUsers', 'selCats', 'selUsers', 'selBrands'));
    }
    // update status
    public function updateCouponStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']  == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'coupon_id' => $data['coupon_id']
            ]);
        }
    }
    // delete coupon
    public function deleteCoupon($id)
    {
        Coupon::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Coupon delete successfully');
    }
}
