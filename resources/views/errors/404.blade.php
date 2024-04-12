<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('front/css/error.css') }}">
    <title>404</title>
</head>

<body>
    <div class="error">
        <div class="error_wrapper">
            <div class="error_head">
                <span class="error_404">
                    404
                </span>
                <span class="error_text">
                    Page Not Fount !
                </span>
                <span class="error_text2">
                    we couldn't find the page you are looking for
                </span>
            </div>
            <div class="error_body">
                <img src="{{ asset('front/images/404.png') }}" alt="">
            </div>
            <div class="error_footer">
                <div class="leftTree">
                    <img src="{{asset('front/images/tree.png')}}" alt="">
                </div>
                
            </div>
        </div>
    </div>

</body>

</html>
