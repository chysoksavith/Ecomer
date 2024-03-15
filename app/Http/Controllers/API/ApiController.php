<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
                "name" => "required",
                "email" => "required|email|unique:users",
                "password" => "required",
            ];
            $customMessages = [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
                "email.unique" => "Email already exist",
                "password.required" => "password is required"
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->mobile = $data['mobile'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'User register successfully'
                ], 201);
            }
        }
    }
    // login
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only('email', 'password');

            $rules = [
                'email' => "required|email|exists:users,email",
                'password' => 'required'
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.exists' => 'Email does not exist',
                'password.required' => 'Password is required'
            ];

            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                return response()->json(
                    $validator->errors(),
                    422
                );
            }

            $user = User::where('email', $data['email'])->first();

            if ($user) {
                // verify the password
                if (password_verify($data['password'], $user->password)) {
                    return response()->json([
                        'userDetails' => $user,
                        'status' => true,
                        'message' => 'User login successfully'
                    ], 201);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Password is incorrect'
                    ], 422);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email is incorrect'
                ], 422);
            }
        }
    }
    // update user detail
    public function updateUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
                'name' => 'required'
            ];
            $customMessages = [
                'name.required' => 'name is required'
            ];
            $validator = Validator::make($rules, $customMessages, $data);

            if ($validator->fails()) {
                return response()->json(
                    $validator->errors(),
                    422
                );
            }

            // verify user id
            $userCount = User::where('id', $data['id'])->count();
            if ($userCount > 0) {
                if(empty($data['address'])){
                    $data['address'] = "";
                }
                if(empty($data['city'])){
                    $data['city'] = "";
                }
                if(empty($data['state'])){
                    $data['state'] = "";
                }
                if(empty($data['country'])){
                    $data['country'] = "";
                }
                if(empty($data['pincode'])){
                    $data['pincode'] = "";
                }

                // update user
                User::where('id', $data['id'])->update([
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                    'pincode' => $data['pincode']
                ]);

                // fetch user details
                $userDetails = User::where('id', $data['id'])->first();
                return response()->json([
                    "userDetails" => $userDetails,
                    'status' => true,
                    "message" => "user update successfully"
                ], 201);
            } else {
                $message = "user does not exist";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ], 422);
            }
        }
    }
    // get category
}
