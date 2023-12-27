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
    <title>EcoStore</title>
</head>

<body>

    @include('client.layouts.header')

    @yield('content')

    <main>
        @include('client.layouts.footer')
    </main>

    @yield('scripts')

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    {{-- ajax  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    {{-- custom --}}
    <script src="{{ asset('front/js/header.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <script src="{{ asset('front/js/filter.js') }}"></script>
    <script src="{{ asset('front/js/imageZoom.js') }}"></script>
    <script src="{{ asset('front/js/btnIncreasement.js') }}"></script>

</body>

</html>
