@extends('client.layouts.layout')
@section('content')
    <div class="regis">
        <div class="creatanacc">
            <span class="hekk">Create New Customer Account</span>
        </div>
        <div class="containeUser">
            <div class="MainContainerRegister">
                <div class="containerRegister">
                    <span class="notamember">
                        Personal Information
                    </span>
                    <form id="registerForm" action="" method="post">
                        @csrf
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Name <span class="redValidation">*</span></label>
                            <input type="text" id="reg_name" name="name" class="inputLogin">
                            <p id="register-name"></p>
                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Mobile <span class="redValidation">*</span></label>
                            <input type="number" class="inputLogin" id="reg_mobile" name="mobile">
                            <p id="register-mobile"></p>
                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                            <input type="email" class="inputLogin" id="reg_email" name="email">
                            <p id="register-email"></p>
                        </div>
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Password <span class="redValidation">*</span></label>
                            <input type="password" class="inputLogin" id="reg_password" name="password">
                            <p id="register-password"></p>
                        </div>
                        <div class="inputFiel inputregister">
                            <a href="{{ route('login.user') }}" class="SignIntBtnDetail"
                                style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                Back
                            </a>

                            <a href="" style="text-decoration: none;">
                                <button type="submit" class="SignUptBtn">Create an Account</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
