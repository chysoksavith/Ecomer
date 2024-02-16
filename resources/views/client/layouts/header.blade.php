<?php
use App\Models\Category;
$categories = Category::getCategories();
$totalCartItems = totalCartItems();

?>
<header>
    <div class="header_nav" id="headerNav">
        <nav class="MenuREs">
            <ul>
                <li>
                    <span class="LogoAside" id="menuBtn">
                        <img class="logo" src="{{ asset('icons8-menu-50.png') }}" alt="">
                    </span>

                </li>
            </ul>
        </nav>
        <nav class="CollectionNav">
            <ul class="nav-links">
                <li>
                    <span class="NavHead StyleSmall">
                        <a href="{{ url('/') }}" style="text-decoration: none; color: black;">
                            Home
                        </a>
                    </span>
                </li>

                {{-- mega dropdown --}}
                @foreach ($categories as $category)
                    <li class="headerLi">
                        <div class="dropdown" data-dropdown>
                            <span class="link StyleSmall MainCategory capitalize" data-dropdown-button>
                                {{ $category->category_name }}
                            </span>
                            <div class="dropdown-memu">
                                @if (count($category->subCategories))
                                    <div class="mainsubcategory">
                                        @foreach ($category->subCategories as $subcategory)
                                            <div class="subcategory">
                                                <div class="dropdown-heading">
                                                    <a href="{{ url($subcategory->url) }}" class="subtxt capitalize">
                                                        {{ $subcategory->category_name }}
                                                    </a>
                                                </div>
                                                @if (count($subcategory->subCategories))
                                                    <div class="dropdown-links">
                                                        @foreach ($subcategory->subCategories as $subsubcategory)
                                                            <a href="{{ url($subsubcategory->url) }}"
                                                                class="subsubtxt capitalize">
                                                                {{ $subsubcategory->category_name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                    </li>
                @endforeach


            </ul>
        </nav>
        <a class="LogoHeader" href="{{ route('HomePage') }}">
            <img src="{{ asset('pngwing.com.png') }}" alt="">
        </a>

        <nav class="NavREs">
            <ul>
                {{-- search --}}
                <li class="NavLiRes"><a href="" class="Ico">
                    </a>
                </li>
                <li>
                    <div class="dropdown" data-dropdown>
                        <span class="fa-solid fa-magnifying-glass icoHead link  " data-dropdown-button></span>
                        <div class="dropdown-memu">
                            <div class=" divSearchdiv">
                                <input type="search" class="searchHeader" id="searchHeader"
                                    placeholder="Search for produts">
                                <button class="btnSearch">
                                    <i class="fa-solid fa-magnifying-glass icoHead"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </li>
                {{-- wishList --}}
                <li class="NavLiRes">
                    <a href="" class="Ico"><i class="fa-regular   fa-heart  icoHead"></i>
                        <span class="bagg">
                            <p>1</p>
                        </span>
                    </a>
                </li>
                {{-- cart --}}
                <li class="NavLiRes">
                    <span class="Ico" id="bagIcon"><i class="fa-solid fa-bag-shopping icoHead dropbtnminiCart"></i>
                        <span class="bagg totalCartItems">
                            <p>{{ $totalCartItems }}</p>
                        </span>
                    </span>
                    <div class="mini-cart dropdownminiCart" id="appendHeaderCartItems">
                        @include('client.layouts.Header_smallCart')
                    </div>
                </li>

                {{-- user --}}
                <li class="NavLiRes">
                    <i class="fa-regular fa-user icoHead dropbtnAccount"> </i>
                    <div class="dropdownAccount">
                        <div class="dropdown-contentAccount" id="myDropdownAccount">
                            {{-- if auth login it show account and signout if not it show signup and signin --}}
                            {{-- <div class="contentUserAccount">
                                <ul>
                                    @if (Auth::check())
                                        <li>
                                            <a href="{{ url('user/account') }}">
                                                account
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/logout') }}">
                                                sign out
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ url('user/register') }}">
                                                Sign up
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/login') }}">
                                                Sign in
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div> --}}
                            <div class="accSudeBar">
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
                                            <a href="{{url('user/login')}}"class="hoverunderLine">
                                                Sign in
                                            </a>
                                        </li>
                                    </ul>
                                @endif


                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </nav>
    </div>

    {{-- side bar add to cart --}}

    {{-- aside menu --}}
    @include('client.layouts.aside')
</header>
@section('scripts')
@endsection
