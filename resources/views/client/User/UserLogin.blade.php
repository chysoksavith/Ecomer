@extends('client.layouts.layout')
@section('content')
    <div class="regis">
        <div class="creatanacc">
            <span class="hekk"></span>
        </div>
        <div class="containeUser">
            <div class="MainContainerUser forgotpasscontain">
                <div class="leftLogin">
                    <div class="secondLeftLogin">
                        <span class="SigninTitle">Sign in</span>
                        <p id="login-error"></p>
                        <form id="loginForm" action="javascript:;" method="post">
                            @csrf
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                                <input type="email" class="inputLogin" id="login-email" name="email">
                                <p id="email-error"></p>
                            </div>
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Password <span class="redValidation">*</span></label>
                                <input type="password" class="inputLogin" id="passwordInput" id="login-password"
                                    name="password">
                                <p id="password-error"></p>
                            </div>
                            <div class="inputFiel showPass">
                                <input type="checkbox" class="checkboxshowpass" id="showPasswordCheckbox">

                                <span class="showPasswordTxt">
                                    Show Password

                                </span>
                            </div>
                            <div class="inputFiel showPass">
                                <button type="submit" id="userLoginLoader" class="SignIntBtnDetail">SignIn</button>

                                <a href="{{ url('user/forgot-password') }}" class="showPasswordTxt fogotpass">
                                    Forgot Password

                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="rightLogin">
                    <div class="secondRightLogin">
                        <div class="divNotamembertxt">
                            <span class="notamember">
                                Not a Member yet?
                            </span>
                            <span class="detailmember">Creating an account has many benefits: check out faster, keep more
                                than
                                one address, track
                                orders and more.</span>
                            <a href="{{ route('user.register') }}" style="text-decoration: none;">
                                <button type="submit" class="SignUptBtnDetail">Create an Account</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('showPasswordCheckbox').addEventListener('change', function() {
            var passwordInput = document.getElementById('passwordInput');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
@endsection
