@php
    use App\Models\Ratings;

    $rating = \App\Models\Ratings::with('user', 'product')->where('status', 1)->orderBy('created_at', 'desc')->get();

    // get average rating of product
    $ratingSum = Ratings::sum('rating');
    $ratingCount = Ratings::count();
    $avgRating = null; // Initialize $avgRating to null
    $avgStartRating = null; // Initialize $avgStartRating to null

    if ($ratingCount > 0) {
        $avgRating = round($ratingSum / $ratingCount, 2);
        $avgStartRating = round($ratingSum / $ratingCount);
    }
    // Set session for recently view items
    if (!Session::has('session_id')) {
        $session_id = md5(uniqid(rand(), true));
        Session::put('session_id', $session_id);
    } else {
        $session_id = Session::get('session_id');
    }

@endphp
@if (!empty($avgStartRating))
    <div class="section-review">
        <h2 class="title_review">
            WHAT OUR BELOVED <br>
            CUSTOMERS SAY
        </h2>
        <div class="starings DiscoAFinal reviewLandingPages">
            <div class="wrapper_reviewlanding">

                @if ($avgStartRating == 0)
                    <span class="title_base_review">
                        None
                    </span>
                @elseif ($avgStartRating <= 1)
                    <span class="title_base_review">
                        Poor
                    </span>
                @elseif ($avgStartRating <= 3)
                    <span class="title_base_review">
                        Medium
                    </span>
                @elseif ($avgStartRating <= 5)
                    <span class="title_base_review">
                        Good
                    </span>
                @else
                    <span class="title_base_review">
                        Excellent
                    </span>
                @endif

                @if ($avgStartRating > 0)
                    @php
                        $star = 1;
                        while ($star <= $avgStartRating) {
                            echo '<div class="clip-star"></div>';
                            $star++;
                        }
                    @endphp
                @endif

                <span class="base_reviewTotal leftreview">{{ $avgRating }}</span>

                <span class="TotalReview landingtotalreview">Base on {{ $rating->count() }} reviews</span>
            </div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($rating as $rate)
                <div class="swiper-slide">
                    <ul class="ulReview">
                        <li class="name_review">
                            <span class="name_landingreview">
                                {{ $rate->user->name }}
                            </span>
                            @php
                                $count = 0;
                                while ($count < $rate->rating) {
                                    echo '<div class="clip-star starCmt startlanding"></div>';
                                    $count++;
                                }
                            @endphp
                        </li>
                        <li class="verifyUser">

                            <span class="textverifyUser">Verified Customer</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M15.418 5.643a1.25 1.25 0 0 0-1.34-.555l-1.798.413a1.25 1.25 0 0 1-.56 0l-1.798-.413a1.25 1.25 0 0 0-1.34.555l-.98 1.564c-.1.16-.235.295-.395.396l-1.564.98a1.25 1.25 0 0 0-.555 1.338l.413 1.8a1.25 1.25 0 0 1 0 .559l-.413 1.799a1.25 1.25 0 0 0 .555 1.339l1.564.98c.16.1.295.235.396.395l.98 1.564c.282.451.82.674 1.339.555l1.798-.413a1.25 1.25 0 0 1 .56 0l1.799.413a1.25 1.25 0 0 0 1.339-.555l.98-1.564c.1-.16.235-.295.395-.395l1.565-.98a1.25 1.25 0 0 0 .554-1.34L18.5 12.28a1.25 1.25 0 0 1 0-.56l.413-1.799a1.25 1.25 0 0 0-.554-1.339l-1.565-.98a1.25 1.25 0 0 1-.395-.395zm-.503 4.127a.5.5 0 0 0-.86-.509l-2.615 4.426l-1.579-1.512a.5.5 0 1 0-.691.722l2.034 1.949a.5.5 0 0 0 .776-.107z"
                                    clip-rule="evenodd" />
                            </svg>
                        </li>
                        <li>
                            <div class="nameItemUserReview">
                                <span class="textNameiteREviews">
                                    {{ $rate->product->product_name }}
                                </span>
                            </div>
                        </li>
                        <li>
                            {{-- descroption user cmt --}}
                            <div class="nameItemUserReview">
                                <p class="textDesiteREview">
                                    {{ $rate->review }}
                                </p>
                            </div>
                        </li>
                        <li>
                            {{-- date --}}
                            <div class="nameItemUserReview dateReview datelandingpage">
                                <span class="date ">
                                    {{ $rate->created_at ? $rate->created_at->diffForHumans() : 'Unknown' }}
                                </span>
                            </div>
                        </li>
                    </ul>


                </div>
            @endforeach

        </div>
    </div>
@endif
