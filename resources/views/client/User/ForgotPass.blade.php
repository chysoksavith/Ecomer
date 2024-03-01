@extends('client.layouts.layout')
@section('content')
    <div class="regis">
        <div class="creatanacc">
            <span class="hekk">Forgot Password ?</span>
        </div>
        <div class="containeUser">
            <div class="MainContainerRegister forgotpasscontain">
                <div class="containerRegister">
                    <span class="notamember">
                        Password Reset
                    </span>
                    <span class="detailResetpASS">
                        Enter Your Email To Reset Your Password
                    </span>
                    <p id="forgot-success"></p>
                    <form id="forgotForm" action="javascript:;" method="post">
                        @csrf
                        <div class="inputFiel">
                            <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                            <input type="email" id="user_email" name="email" class="inputLogin">
                            <p class="forgot-email"></p>
                        </div>

                        <div class="inputFiel inputregister">
                            <a href="{{ route('login') }}" class="SignIntBtnDetail"
                                style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                Back
                            </a>

                            <a href="" style="text-decoration: none;">
                                <button type="submit" class="SignUptBtn">Submit</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
