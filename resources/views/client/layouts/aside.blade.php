<div class="backdrop"></div>
<aside>

    <div class="tab__content">
        <div class="tab">

            <a href="javascript:;" class="tablinks" id="defaultOpen" onclick="openCity(event, 'Menu')">
                <div class="tab__wrap">
                    <span class="tab__text">Menu</span>
                </div>
            </a>
            <a href="javascript:;" class="tablinks" onclick="openCity(event, 'Setting')">
                <div class="tab__wrap">
                    <span class="tab__text">Setting</span>
                </div>
            </a>
        </div>

        <div id="Menu" class="tabcontent">
            <section class="tab_overScroll">
                <h3 style="font-size:16px; font-weight: 500;">Menu</h3>
                <p style="font-size:14px;">Good Respomsible</p>
                <ul class="nav__list" style="margin-top: 15px;">
                    <li>
                        <a href="{{ url('/') }}" class="nav__link">
                            <span class="hover__cate">
                                home
                            </span>
                        </a>
                    </li>
                    @foreach ($categories as $item)
                        <li class="dropdown__item">
                            <div class="nav__link">
                                <span class="hover__cate capitalize">
                                    {{ $item->category_name }}
                                </span>
                                @if (count($item->subCategories))
                                    <i class="fa-solid fa-chevron-down dropdown_arrow"></i>
                                @endif
                            </div>
                            @if (count($item->subCategories))
                                <ul class="dropdown__menu">
                                    <li class="dropdown__subitem">
                                        @foreach ($item->subCategories as $subitem)
                                            <div class="dropdown__link">
                                                <a href="{{ url($subitem->url) }}">
                                                    <span class="text__sub">{{ $subitem->category_name }}</span>
                                                </a>
                                                @if (count($subitem->subCategories))
                                                    <!-- Check if subitem has sub-categories -->
                                                    <i class="fa-solid fa-plus dropdown__add"></i>
                                                @endif
                                            </div>
                                            @if (count($subitem->subCategories))
                                                <ul class="dropdown__submenu">
                                                    @foreach ($subitem->subCategories as $subsubitem)
                                                        <li>
                                                            <a href="{{ url($subsubitem->url) }}"
                                                                class="dropdown__sublink">
                                                                <span
                                                                    class="text__sub text__subsub">{{ $subsubitem->category_name }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
        {{-- login setting --}}
        <div id="Setting" class="tabcontent">
            @if (!Auth::check())
                <section>
                    <div class="container_aside">
                        <span class="SigninTitle">Sign in</span>
                        <p id="login-error"></p>
                        <form id="asideLoginForm" action="javascript:;" method="post">
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

    <button class="close"></button>

</aside>
