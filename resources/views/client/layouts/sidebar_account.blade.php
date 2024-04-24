<div class="backdrop_Account"></div>

<div class="side_Account_wrapper">
    <div class="containerIcons">
        <span class="closeAccount" style="cursor: pointer;">
            <i class="fa-solid fa-xmark"></i>
        </span>
    </div>
    <div class="side_containAccount">
        @if (!Auth::check())
            <section>
                <div class="container_aside">
                    <span class="SigninTitle">Sign in</span>
                    <p id="login-error"></p>
                    <form id="sidebarLoginForm" action="javascript:;" method="post">
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
                        <div class="inputFiel df__inputlogin " id="showPass">
                            <button type="submit" id="userLoginLoader" class="SignIntBtnDetail">SignIn</button>

                            <a href="{{ url('user/forgot-password') }}" class="showPasswordTxt fogotpass">
                                Forgot Password

                            </a>
                        </div>
                    </form>
                </div>
                <div class="container_aside_notamember">
                    <div class="divNotamembertxt">
                        <span class="notamember">
                            Not a Member yet?
                        </span>
                        <span class="detailmember">Creating an account has many benefits: check out faster, keep
                            more
                            than
                            one address, track
                            orders and more.</span>
                        <a href="{{ route('user.register') }}" style="text-decoration: none;">
                            <button type="submit" class="SignUptBtnDetail">Create an Account</button>
                        </a>
                    </div>
                </div>
            </section>
        @else
            @if (Auth::check())
                <ul class="ulAccSidebar ">
                    <li class="liAccSidebar">
                        <span class="spantxt">
                            Welcone, {{ Auth::user()->name }}!
                        </span>
                    </li>
                    <li class="liAccSidebar">
                        <a href="{{ url('user/account') }}">
                            My account
                        </a>
                    </li>

                    <li class="liAccSidebar">
                        <a href=""class="hoverunderLine">
                            My Orders
                        </a>
                    </li>
                    <li class="liAccSidebar">
                        <a href=""class="hoverunderLine">
                            My WishList
                        </a>
                    </li>
                    <li class="liAccSidebar">
                        <a href=""class="hoverunderLine">
                            Checkout
                        </a>
                    </li>
                </ul>

                <ul class="ulAccSidebar ulLogout">
                    <li>
                        <a href="{{ url('user/logout') }}">
                            sign out
                        </a>
                    </li>
                </ul>
            @else
                <ul class="ulAccSidebar ">
                    <li class="liAccSidebar">
                        <span class="spanPleaselOGIN">Please Login</span>
                    </li>
                    <li class="liAccSidebar">
                        <a href="{{ url('user/login') }}"class="hoverunderLine">
                            Sign in
                        </a>
                    </li>
                </ul>
            @endif
        @endif
    </div>
</div>
