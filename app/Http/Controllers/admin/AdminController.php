<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
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
                return redirect('admin/dashboard');
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
}
