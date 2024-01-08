<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                    'url' => $redirectUrl,
                ]);
            }
        }


        return view('client.User.UserRegister');
    }
}
