<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- cdn icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- style css --}}
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/homePages.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/listing.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/sortNewstListing.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/contentTabDetail.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animationBtn.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/contact_us.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/thank.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/order.css') }}">

    {{-- AOS plugin --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    {{-- swiper js  --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <title>EcoStore</title>
</head>

<body>
    <div class="loader">
        <img src="{{ asset('front/images/Spinner.gif') }}" alt="loading...">
    </div>
    @include('client.layouts.header')

    @yield('content')

    <main>
        @include('client.layouts.footer')
    </main>
    <div class="menu-float">
        <div class="bt-nav" onclick="scrollToTop()">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 1024 1024">
                <path fill="currentColor"
                    d="M8.2 751.4c0 8.6 3.4 17.401 10 24.001c13.2 13.2 34.8 13.2 48 0l451.8-451.8l445.2 445.2c13.2 13.2 34.8 13.2 48 0s13.2-34.8 0-48L542 251.401c-13.2-13.2-34.8-13.2-48 0l-475.8 475.8c-6.8 6.8-10 15.4-10 24.2z" />
            </svg>
        </div>

    </div>
    @yield('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    {{-- ajax  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    {{-- custom --}}
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('front/js/header.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <script src="{{ asset('front/js/filter.js') }}"></script>
    <script src="{{ asset('front/js/imageZoom.js') }}"></script>
    <script src="{{ asset('front/js/btnIncreasement.js') }}"></script>
    <script src="{{ asset('front/js/cart.js') }}"></script>
    <script src="{{ asset('front/js/Login_RegisterForm.js') }}"></script>
    <script src="{{ asset('front/js/accountForm.js') }}"></script>
    <script src="{{ asset('front/js/animatonProduct.js') }}"></script>
    {{-- AOS plugin --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            var button = document.querySelector('.bt-nav');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                button.style.opacity = "1"; /* Show button if scroll position is not at the top */
            } else {
                button.style.opacity = "0"; /* Hide button if scroll position is at the top */
            }
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    </script>
    <script>
        function showToast(message, type = "success") {
            Toastify({
                text: message.replace(/<br\s*\/?>/gi, "\n"),
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: type === "success" ? "#c3e235" : "red",
                stopOnFocus: true,
                offset: {
                    y: 40 // Set the offset from the top
                }
            }).showToast();
        }

        @if (session('error_message'))
            showToast("{{ session('error_message') }} ", "error");
        @endif
        @if (session('success_message'))
            showToast("{{ session('success_message') }}", "success");
        @endif
    </script>
    <script>
        // Execute the following script after the page has loaded
        $(document).ready(function() {
            // Select all elements with the 'capitalize' class and apply custom capitalization
            $('.capitalize').each(function() {
                var text = $(this).text();
                // Convert the entire word to lowercase and then capitalize the first letter
                $(this).text(text.toLowerCase().replace(/^(.)|\s(.)/g, function($1) {
                    return $1.toUpperCase();
                }));
            });
        });
    </script>
    <!-- Add this script at the end of your HTML file -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mainCategories = document.querySelectorAll('.MainCategory');

            mainCategories.forEach(function(mainCategory) {
                var subcategories = mainCategory.nextElementSibling;

                if (subcategories && subcategories.querySelector('.subcategory') === null) {
                    mainCategory.removeAttribute('data-dropdown-button');
                    mainCategory.style.cursor = 'default';
                }
            });
        });
    </script>

    @if (session('toast'))
        <script>
            // Extract toast data from the session
            var toastData = @json(session('toast'));

            // Call your showToast function
            showToast(toastData.message, toastData.type);
        </script>
    @endif

</body>

</html>
