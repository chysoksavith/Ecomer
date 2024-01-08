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
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Name <span class="redValidation">*</span></label>
                        <input type="text" class="inputLogin" name="">
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Mobile <span class="redValidation">*</span></label>
                        <input type="number" class="inputLogin" id="passwordInput">
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                        <input type="email" class="inputLogin">
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Password <span class="redValidation">*</span></label>
                        <input type="password" class="inputLogin">
                    </div>
                    <div class="inputFiel inputregister">
                        <a href="{{ route('login.user') }}" style="text-decoration: none;">
                            <button type="submit" class="SignIntBtnDetail">Back</button>
                        </a>
                        <a href="" style="text-decoration: none;">
                            <button type="submit" class="SignUptBtn">Create an Account</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
