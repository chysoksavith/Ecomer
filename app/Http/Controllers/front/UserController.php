<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
                $user->status = 0;
                $user->save();
                // activate when user confirm email account
                $email = $data['email'];
                $messageData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'code' => base64_encode($data['email'])
                ];


                Mail::send('email.confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm you Your Accounts');
                });
                // redirect back user with a success
                $redirectUrl = url('user/register');
                return response()->json([
                    'status' => true,
                    'type' => 'success',
                    'url' => $redirectUrl,
                    'message' => 'Please confirm your email to activate your Account!'
                ]);


                // user can login after data go to table
                // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //     // send mail to user after login
                //     $email = $data['email'];
                //     $messageData = [
                //         'name' => $data['name'],
                //         'mobile' => $data['mobile'],
                //         'email' => $data['email']
                //     ];

                //     Mail::send('email.registerEmail', $messageData, function ($message) use ($email) {
                //         $message->to($email)->subject('Welcome to Our Website');
                //     });



                //     $redirectUrl = url('cart');
                //     return response()->json([
                //         'status' => true,
                //         'type' => 'success',
                //         'url' => $redirectUrl,
                //     ]);
                // }
            } else {
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
    // confrim acc
    public function confirmAccount($code)
    {
        $email = base64_decode($code);  // Use base64_decode to get the email back
        $userCount = User::where('email', $email)->count();

        if ($userCount > 0) {
            $userDetails = User::where('email', $email)->first();

            if ($userDetails->status == 1) {
                // Redirect user to login page with the error message
                return redirect('user/login')->with('toast', [
                    'message' => 'Your account is already activated. You can login',
                    'type' => 'error'
                ]);
            } else {
                User::where('email', $email)->update(['status' => 1]);

                // send welcome email
                $messageData = [
                    'name' => $userDetails->name,
                    'mobile' => $userDetails->mobile,
                    'email' => $userDetails->email
                ];

                Mail::send('email.registerEmail', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Welcome to Our Website');
                });

                // go to cart page
                return redirect('user/login')->with('toast', [
                    'message' => 'Your account is activated. You can login now!',
                    'type' => 'success'
                ]);
            }
        } else {
            abort(404);
        }
    }
}
