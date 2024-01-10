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
    public function loginUser(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|max:250|exists:users',
                    'password' => 'required|min:6'
                ],
                [
                    'email.required' => 'Please enter your email address.',
                    'email.email' => 'Please enter a valid email address.',
                    'email.max' => 'The email address must not exceed 250 characters.',
                    'email.exists' => 'The provided email does not exist in our records.',
                    'password.required' => 'Please enter your password.',
                    'password.min' => 'The password must be at least 6 characters long.'
                ]
            );

            if ($validator->passes()) {
                // user can log in after data go to table
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // if status 0 then it logout
                    if (Auth::user()->status == 0) {
                        Auth::logout();
                        return response()->json([
                            'status' => false,
                            'type' => 'inactive',
                            'message' => 'Your account is not activated yet',
                        ]);
                    } else {
                        $redirectUrl = url('cart');
                        return response()->json([
                            'status' => true,
                            'type' => 'success',
                            'url' => $redirectUrl,
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'type' => 'incorrect',
                        'message' => 'You have entered an incorrect email or password!'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'type' => 'error',
                    'error' => $validator->messages()
                ]);
            }
        }
        return view('client.User.UserLogin');
    }
    // ------------------------------------------------------------------------------------------------

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
    // ------------------------------------------------------------------------------------------------
    // forgot password
    public function forgotPassword(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|max:250|exists:users'
                ],
                [
                    'email.email' => 'Email does not Exists'
                ]
            );

            if ($validator->passes()) {
                // send email to user with reset password link
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'code' => base64_encode($data['email'])];
                Mail::send('email.reset_password', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Reset your Password');
                });
                return response()->json([
                    'type' => 'success',
                    'message' => 'Reset Password Link sent to you register email'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'type' => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        } else {
            return view('client.User.ForgotPass');
        }
    }
    // confirm forgot password
    public function resetPassword(Request $request, $code = null)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $email = base64_decode($data['code']);
            $userCount = User::where('email', $email)->count();
            if($userCount > 0){
                // update new password for new users
                User::where('email', $email)->update(['password' => bcrypt($data['password'])]);

                // send confirm email to user
                $messageData = ['email' => $email];
                Mail::send('email.new_password_confirmation', $messageData, function($message) use($email){
                    $message->to($email)->subject('Password Updated');
                });
                return response()->json([
                    'type' => 'success',
                    'message' => 'Password reset for your account Check you Email You can login now'
                ]);

            }else{
                abort(404);
            }
        } else {
            return view('client.User.reset_password')->with(compact('code'));
        }
    }
    // ------------------------------------------------------------------------------------------------

    // logout
    public function userLogout()
    {
        Auth::logout();
        return redirect('user/login');
    }
}
