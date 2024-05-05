<div class="wrapper__mobileNav">
    <div class="wrap__acc">
        <i class="fa-solid fa-bars icon_mbiel" onclick="FunctionMobileNav()"></i>
        <span class="myAccount">MY ACCOUNT</span>
    </div>
    <div class="mobileNav__Content" id="myLinks">
        <ul class="mobileNav">
            <li>
                <a href="{{ url('user/account') }}">My Account</a>
            </li>
            <li>
                <a href="{{ url('user/orders') }}">My Orders</a>
            </li>
            <li>
                <a href="">My Wishlist</a>
            </li>
            <li>
                <a href="{{ url('user/update-password') }}">Update Password</a>
            </li>
        </ul>
    </div>
</div>
@section('scripts')
    <script>
        function FunctionMobileNav() {
            var x = document.getElementById("myLinks");
            var icon = document.querySelector(".icon_mbiel");

            if (x.style.display === "block") {
                x.style.display = "none";
                icon.classList.remove("fa-xmark"); // Remove the X mark icon
                icon.classList.add("fa-bars"); // Add the bars icon
            } else {
                x.style.display = "block";
                icon.classList.remove("fa-bars"); // Remove the bars icon
                icon.classList.add("fa-xmark"); // Add the X mark icon
            }
        }
    </script>
@endsection
