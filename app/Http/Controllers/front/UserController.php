<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginUser(){
        return view('client.User.UserLogin');
    }

    // register
    public function registerUser(){
        return view('client.User.UserRegister');
    }
}
