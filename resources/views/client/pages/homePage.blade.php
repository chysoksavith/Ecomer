@extends('client.layouts.layout')
@section('content')
    <section class="FirstSection">
        <div class="WrapperVdo">
            <div class="vdoA video-container">

                    <div class="loading-spinner">Loading...</div>
                    <video id="myVideo" class="video" autoplay loop muted preload="auto">
                        <source src="{{ asset('FearofGod.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
         

            </div>
            <div class="title">
                <span class="MainTotle">ATHLETICS</span>
                <span class="titleShop">
                    <a href="{{ route('front.home') }}">SHOP</a>
                </span>
            </div>
        </div>
    </section>
    <div class="MainContain">
        <div class="wrapper-container">
            <div class="containerBrand">
                <div class="wrap-img">
                    <div class="BraImg">
                        <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                            alt="">
                    </div>
                    <div class="relativeTitle">
                        <span>FEAR OF GOD</span>
                    </div>
                </div>
            </div>
            <div class="containerBrand">
                <div class="wrap-img">
                    <div class="BraImg">
                        <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                            alt="">
                    </div>
                    <div class="relativeTitle">
                        <span>FEAR OF GOD</span>
                    </div>
                </div>
            </div>
            <div class="containerBrand">
                <div class="wrap-img">
                    <div class="BraImg">
                        <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg"
                            alt="">
                    </div>
                    <div class="relativeTitle">
                        <span>FEAR OF GOD</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var video = document.getElementById('myVideo');
        var spinner = document.querySelector('.loading-spinner');

        // Show loading spinner until the video is ready to play
        video.addEventListener('canplay', function () {
            spinner.style.display = 'none';
            video.style.display = 'block';
        });

        // Fallback for browsers that do not support 'canplay' event
        video.addEventListener('loadeddata', function () {
            spinner.style.display = 'none';
            video.style.display = 'block';
        });

        // Handle errors during video loading
        video.addEventListener('error', function () {
            spinner.style.display = 'none';
            console.error('Error loading the video.');
        });
    });
</script>

@endsection
