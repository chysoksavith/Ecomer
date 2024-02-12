<span class="accSpan">
    Hello {{ Auth::user()->name }}
</span>
<ul class="acc">
    <li>
        <a href="{{ url('user/account') }}" class="hoverunderLine">
            My Billing Contact Address
        </a>
    </li>
    <li>
        <a href="" class="hoverunderLine">
            My Orders
        </a>
    </li>
    <li>
        <a href=""class="hoverunderLine">
            My WishList
        </a>
    </li>
    <li>
        <a href="{{ url('user/update-password') }}"class="hoverunderLine">
            Update Password
        </a>
    </li>
</ul>
