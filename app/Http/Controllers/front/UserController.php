<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginUser()
    {
        return view('client.User.UserLogin');
    }

    // register
    public function registerUser(Request $request)
    {
        if ($request->ajax()) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:150',
                    'mobile' => 'required|numeric|digits:10',
                    'email' => 'required|email|max:250|unique:users',
                    'password' => 'required|string|min:6'
                ],
                [
                    'email.email' => 'Please enter the valid email',

                ]
            );
            if ($validator->passes()) {

                $data = $request->all();

                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                // user can login after data go to table
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    $redirectUrl = url('cart');
                    return response()->json([
                        'status' => true,
                        'type' => 'success',
                        'url' => $redirectUrl,
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'type' => 'validation',
                    'error' => $validator->messages()
                ]);
            }
        }
        return view('client.User.UserRegister');
    }

    // logout
    public function userLogout()
    {
        Auth::logout();
        return redirect('user/login');
    }
}
