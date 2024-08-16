<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRoles;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\GoalModel;
use App\Models\Order_Product;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductsAttribure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        Session::put('page', 'dashboard');
        $categoryCount = Category::where('status', '=', '1')->count();
        $ProductCount = Product::where('status', '=', '1')->count();
        $brandCount = Brand::where('status', '=', '1')->count();
        $userCount = User::where('status', '=', '1')->count();
        $orderCount = Orders::count();
        // complete Pruches
        $completePurchase = Orders::where('order_status', '=','Delivered')->count();
        $totalIncome = Orders::sum('grand_total');
        $topSaleItems = Order_Product::select('*', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('product_id') // Group by product_id and product_name
            ->orderBy('total_sales', 'desc')
            ->take(10)
            ->get();
        $totalInventory = ProductsAttribure::where('status', '=', '1')->sum('stock');
        $goalAddToCart = Cart::count();
        // store session user visit website
        $visitData = $request->session()->get('visit_data');
        if (!$visitData) {
            $visitData = [];
        }
        $goal = GoalModel::get();
        // store or update visit data
        $visitData['last_visit_time'] = now();
        $visitData['user_agent'] = $request->header('User-Agent');

        $request->session()->put('visit_data', $visitData);
        return view('admin.dashboard')->with(compact('goal','completePurchase','visitData', 'goalAddToCart', 'totalInventory', 'categoryCount', 'ProductCount', 'brandCount', 'userCount', 'orderCount', 'totalIncome', 'topSaleItems'));
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30'
            ];

            $customMessages = [
                'email.required' => "Email is required",
                'email.email' => 'Valid Email is required',
                'password.required' => "Password is required",
            ];
            $this->validate($request, $rules, $customMessages);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {

                // remember admin email and password
                if (isset($data['remember']) && !empty($data['remember'])) {
                    setcookie("email", $data['email'], time() + 3600);
                    setcookie("password", $data['password'], time() + 3600);
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                }

                return redirect('admin/dashboard')->with('success_message', 'Welcome to Dashboard');
            } else {
                return redirect()->back()->with("error_message", "Invalid Email Or Invalid password");
            }
        }
        return view('admin.login');
    }
    // logout
    public function logout(Request  $request)
    {
        Auth::guard('admin')->logout();
        return redirect('admin/logout');
    }

    public function updatePassword(Request $request)
    {
        Session::put('page', 'update-password');

        if ($request->isMethod('post')) {
            $data = $request->all();

            // check current pwd is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['new_password'] == $data['confirm_password']) {


                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);

                    // Flash a success message
                    return redirect()->back()->with('success_message', 'Your update was successful.');
                } else {
                    // Flash an error message
                    return redirect()->back()->with('error_message', 'Your new password and retyped password do not match.');
                }
            } else {
                // Flash an error message
                return redirect()->back()->with('error_message', 'Your current password is not correct.');
            }
        }

        return view('admin.update_password');
    }


    // check current pass
    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    // update admin detail
    public function updateAdminDetail(Request $request)
    {
        Session::put('page', 'update-detail');
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'admin_name' => 'required|regex:/^[a-zA-Z0-9]{3,}$/|max:255',
                'admin_mobile' => 'required|numeric|digits:10',
                'admin_image' => 'image'
            ];

            $customMessages = [
                'admin_name.required' => 'Admin name is required',
                'admin_name.regex' => 'Valid name is required and should only contain letters and numbers (at least 3 characters)',
                'admin_name.max' => 'Valid name should not exceed 255 characters',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Mobile should be a numeric value',
                'admin_mobile.digits' => 'Mobile should be 10 digits',
                'admin_image.image' => 'Valid image required',
            ];

            $this->validate($request, $rules, $customMessages);

            // Image upload
            if ($request->hasFile('admin_image')) {
                $image = $request->file('admin_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'admin/images/photos/' . $imageName;
                $image->move(public_path('admin/images/photos'), $imageName);
            } else if (!empty($data('current_image'))) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }

            // Update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update([
                    'name' => $data['admin_name'],
                    'mobile' => $data['admin_mobile'],
                    'image' => $imageName ?? null,
                ]);

            return redirect()->back()->with('success_message', 'Your update was successful.');
        }

        return view('admin.update_admin_detail');
    }
    // subadmin
    public function subadmin(Request $request)
    {
        Session::put('page', 'subadmins');
        $subadmins = Admin::where('type','=','subadmin')->get();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }
    // sub admin status
    public function SubAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            Admin::where('id', $data['subadmin_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'subadmin_id' => $data['subadmin_id']]);
        }
    }

    // add edit sub admin
    public function addedit_subadmin(Request $request, $id = null)
    {
        Session::put('page', 'subadmins');

        if ($id == "") {
            $title = "Add SubAdmin";
            $subadminData = new Admin;
            $message = "Subadmin added successfully";
        } else {
            $title = "Edit SubAdmin";
            $subadminData = Admin::find($id);
            $message = "Subadmin updated successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($id == "") {
                $subadminCount = Admin::where('email', $data['email'])->count();
                if ($subadminCount > 0) {
                    return redirect()->back()->with('error_message', 'subadmin Already exist!');
                }
            }
            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'image' => 'image'
            ];
            $customMessages = [
                'name.required' => "Name is required",
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
                'image.image' => 'Valid image is required'
            ];
            $this->validate($request, $rules, $customMessages);
            // Image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'admin/images/photos/' . $imageName;
                $image->move(public_path('admin/images/photos'), $imageName);
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }
            $subadminData->image = $imageName;
            $subadminData->name = $data['name'];
            $subadminData->mobile = $data['mobile'];
            if ($id == "") {
                $subadminData->email = $data['email'];
                $subadminData->type = 'subadmin';
            }
            if ($data['password'] != "") {
                $subadminData->password = bcrypt($data['password']);
            }
            $subadminData->save();
            return redirect('admin/subadmin')->with('success_message', $message);
        }
        return view('admin.subadmins.add_edit_subadmin', compact('title', 'subadminData', 'message'));
    }
    // update role
    public function updateRoles($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            AdminRoles::where('subadmins_id', $id)->delete();

            foreach ($data as $Key => $value) {
                if (isset($value['view'])) {
                    $view = $value['view'];
                } else {
                    $view = 0;
                }
                if (isset($value['edit'])) {
                    $edit = $value['edit'];
                } else {
                    $edit = 0;
                }
                if (isset($value['full'])) {
                    $full = $value['full'];
                } else {
                    $full = 0;
                }


                AdminRoles::where('subadmins_id', $id)
                    ->insert(['subadmins_id' => $id, 'module' => $Key, 'view_access' => $view, 'edit_access' => $edit, 'full_access' => $full]);
            }

            // $role = new AdminRoles;
            // $role->subadmins_id = $id;
            // $role->module = $Key;
            // $role->view_access = $view;
            // $role->edit_access = $edit;
            // $role->full_access = $full;
            // $role->save();

            $message = "Subadmin Roles updated successfully";
            return redirect()->back()->with('success_message', $message);
        }

        $subadminRoles = AdminRoles::where('subadmins_id', $id)->get()->toArray();
        $subadminDetails = Admin::where('id', $id)->first()->toArray();
        $title = "Update" . $subadminDetails['name'] . " Subadmin Role/Permission";

        return view('admin.subadmins.update_role')->with(compact('title', 'id', 'subadminRoles'));
    }
    // delete sub admin
    public function Subadmindestroy($id)
    {
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Sub Admin deleted successfully!');
    }
}
