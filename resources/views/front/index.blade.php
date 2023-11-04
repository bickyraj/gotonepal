@extends('layouts.front')
@section('content')
    <!-- Slider -->
    @include('front.elements.banner2')

    <h1 class="sr-only">Home</h1>

    <!-- Destinations -->
    <div class="py-20 destinations">
        <div class="container">
            <div class="mb-4">
                <p class="mb-2 text-2xl text-center font-handwriting text-primary">Where do you want to go?</p>
                <div class="flex justify-center mb-10">
                    <h2 class="relative px-10 text-3xl font-bold text-gray-600 font-display">
                        Travel Among The Himalayas
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-5">
                @forelse ($destinations as $destination)
                    @include('front.elements.destination_card', ['destination' => $destination])
                @empty
                @endforelse
            </div>
        </div>
    </div><!-- Destinations -->

    {{-- Trips Block One --}}
    <div class="py-20 featured bg-gray">
        <div class="container">

            <div class="flex justify-center">
                <div>
                    <p class="mb-2 text-2xl text-center text-primary font-handwriting">The best of what we offer</p>
                    <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 font-display">
                        {{ Setting::get('homePage')['trip_block_1']['title'] ?? '' }}
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">

                @forelse ($block_1_trips as $block_1_tour)
                    @include('front.elements.tour-card', ['tour' => $block_1_tour])
                @empty
                @endforelse
            </div>
        </div>
    </div> {{-- Trips Block One --}}

    {{-- Activities --}}
    <div class="py-20 activities">
        <div class="container">
            <div class="items-center justify-center gap-20 mb-4 lg:flex">
                <div>
                    <p class="mb-2 text-2xl text-center font-handwriting text-primary">Choose your activity</p>
                    <div class="flex">
                        <h2 class="relative px-10 mb-8 text-3xl font-bold text-center text-gray-600 font-display">
                            Things To Do
                            <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="grid max-w-5xl grid-cols-2 gap-4 mx-auto lg:grid-cols-4 lg:justify-center">
                @foreach ($activities as $activity)
                    @include('front.elements.activity-card', ['activity' => $activity])
                @endforeach
            </div>
        </div>
    </div>{{-- Activities --}}

    <!-- About-->
    <div class="py-20 bg-light">
        <div class="container">
            <div class="grid gap-10 lg:gap-20 lg:grid-cols-2">
                <div>
                    <div class="mb-4">
                        <p class="mb-2 text-2xl text-center font-handwriting text-primary">About Us</p>
                        <div class="flex justify-center mb-8">
                            <h2 class="relative px-10 text-3xl font-bold text-center text-gray-600 font-display">
                                {{ Setting::get('homePage')['welcome']['title'] ?? '' }}
                                <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            </h2>
                        </div>
                    </div>

                    <div class="prose"><?= Setting::get('homePage')['welcome']['content'] ?? '' ?></div>

                </div>
                <div>
                    <p class="mb-2 text-2xl text-center font-handwriting text-primary">Elevate Your Adventure</p>
                    <div class="flex justify-center mb-8">
                        <h2 class="relative px-10 text-3xl font-bold text-center text-gray-600 font-display">
                            Why Choose Us?
                            <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        </h2>
                    </div>
                    <div class="grid gap-10">
                        @foreach ($why_choose_us as $item)
                            <div class="flex gap-4">
                                <img class="flex-shrink-0 w-20 h-20 p-2 bg-white border-2 rounded-full border-accent" src="{{ $item->imageUrl }}" alt="">
                                <div>
                                    <h3 class="mb-2 text-xl font-bold">{{ $item->title }}</h3>
                                    <div class="prose">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->

    {{-- Trips Block Two --}}
    <div class="py-20 featured bg-gray">
        <div class="container">

            <div class="flex justify-center">
                <div>
                    <p class="mb-2 text-2xl text-center text-primary font-handwriting">Popular right now</p>
                    <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 font-display">
                        {{ Setting::get('homePage')['trip_block_2']['title'] ?? '' }}
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">

                @forelse ($block_2_trips as $block_2_tour)
                    @include('front.elements.tour-card', ['tour' => $block_2_tour])
                @empty
                @endforelse
            </div>
        </div>
    </div> {{-- Trips Block Two --}}

    {{-- Reviews --}}
    <div class="py-20">
        <div class="container">
            <p class="mb-2 text-2xl text-center font-handwriting text-primary">Customer Stories & Experiences</p>
            <div class="flex justify-center mb-8">
                <h2 class="relative px-10 text-4xl font-bold text-center text-gray-600 font-display">
                    Reviews
                    <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                </h2>
            </div>
            <div class="grid gap-10 lg:grid-cols-2">
                @forelse ($reviews as $review)
                    <div class="bg-white rounded-lg review">
                        <div class="mb-4 review__content">
                            <h3 class="mb-4 text-xl font-display">{{ $review->title }}</h3>
                            <div class="prose">
                                <p>{{ $review->review }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <img src="{{ $review->thumbImageUrl }}" alt="{{ $review->review_name }}" loading="lazy">
                            <div>
                                <div class="font-bold">{{ ucfirst($review->review_name) }}</div>
                                <div class="text-sm text-gray">{{ $review->review_country }}</div>
                                <div class="flex">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-5 h-5 text-accent">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('front.reviews.index') }}" class="text-primary">
                    View all reviews
                </a>
            </div>
        </div>
    </div>

    {{-- Trip of the month --}}
    <div class="py-20 text-white bg-center bg-cover bg-primary-dark" style="background: linear-gradient(rgba(31,71,32, 0.8), rgba(31,71,32,0.8)), url('{{ asset('assets/front/img/mountains.jpg') }}');">
        <div class="container">
            <div class="flex flex-wrap justify-between gap-10 mb-10">
                <div>
                    <p class="mb-2 text-2xl text-white font-handwriting">This doesn't get any better</p>
                    <div class="flex">
                        <h2 class="relative pr-10 text-4xl font-bold font-display">
                            {{ Setting::get('homePage')['trip_block_3']['title'] ?? '' }}
                            <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        </h2>
                    </div>
                </div>

                <div class="flex justify-end gap-4 trips-month-slider-controls">
                    <button class="p-2 rounded-lg bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                        </svg>
                    </button>
                    <button class="p-2 rounded-lg bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="trips-month-slider">
                @forelse ($block_3_trips as $block3tour)
                    @include('front.elements.tour_card_slider', ['tour' => $block3tour])
                @empty
                @endforelse
            </div>
        </div>
    </div>{{-- Trip of the month --}}

    {{-- Departure Dates --}}
    <div class="px-4 py-20 departure-dates bg-gray">
        <div class="container">
            <div class="items-center justify-between mb-4 lg:flex">
                <h2 class="relative pr-10 text-4xl font-bold font-display">
                    Upcoming departures
                    <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                </h2>

                {{-- <form id="filter-trip-departure-form" action="" method="GET">
                    <div class="form-group">
                        <select name="month" id="select-trip-departure-filter" class="bg-gray">
                            <option selected disabled>Choose Month & Year</option>
                            @php
                                $current_date = \Carbon\Carbon::now();
                            @endphp
                            <option value="{{ $current_date->format('n') }}">{{ $current_date->format('M Y') }}</option>
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $current_date->add('1 month')->format('M Y');
                                @endphp
                                <option value="{{ $current_date->format('n') }}">{{ $current_date->format('M Y') }}</option>
                            @endfor
                        </select>
                    </div>
                </form> --}}
            </div>
            <div class="overflow-hidden border-gray-600">
                <table class="table mb-2 overflow-hidden rounded-lg lg:border max-lg:block">
                    <thead class="max-lg:hidden">
                        <th class="p-2 text-white bg-primary">Trip</th>
                        <th class="p-2 text-white bg-primary">Date</th>
                        <th class="p-2 text-white bg-primary">Price</th>
                        <th class="p-2 text-white bg-primary">Seats Left</th>
                        <th class="bg-primary"></th>
                    </thead>
                    <tbody class="max-lg:block">
                        @foreach ($departures as $departure)
                            <tr class="max-lg:block max-lg:mb-2 @if ($loop->odd) bg-light @else bg-white @endif">
                                <td class="p-2 max-lg:block">
                                    <div class="flex items-center gap-2 text-lg font-display">
                                        <a href="{{ route('front.trips.show', $departure->trip->slug) }}">
                                            {{ $departure->trip->name }}
                                        </a>
                                    </div>
                                </td>
                                <td class="p-2 max-lg:block">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 mr-1 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}" />
                                        </svg>
                                        {{ formatDate($departure->from_date) }} — {{ formatDate($departure->to_date) }}
                                    </div>
                                </td>
                                <td class="p-2 max-lg:block">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 mr-1 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#tag') }}" />
                                        </svg>
                                        <div>
                                            <small class="text-gray"><s>USD {{ number_format($departure->trip->cost) }}</s></small><br>
                                            <span class="text-green">USD <b>{{ number_format($departure->price) }}</b></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 max-lg:block">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 mr-1 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#users') }}" />
                                        </svg>
                                        {{ $departure->seats }} <span class="lg:hidden">seats available</span>
                                    </div>
                                </td>
                                <td class="p-2 max-lg:block">
                                    <a href="{{ route('front.trips.departure-booking', ['slug' => $departure->trip->slug, 'id' => $departure->id]) }}" class="btn btn-sm btn-accent">
                                        Join Group
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>{{-- Departure Dates --}}

    @include('front.elements.plan_trip')

    {{-- Why Travel with us --}}
    <div class="py-20 bg-gray-100">
        <div class="grid max-w-6xl gap-20 mx-auto lg:grid-cols-3">
            <div class="place-self-center">
                <h2 class="mb-10 text-2xl text-center font-display">
                    <div class="mb-2">Watch our</div>
                    <div class="text-5xl font-handwriting">Video Profile</div>
                </h2>
                <div class="text-center">
                    <a href="#" class="inline-flex gap-2">
                        More videos
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10.21 14.77a.75.75 0 01.02-1.06L14.168 10 10.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"></path>
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M4.21 14.77a.75.75 0 01.02-1.06L8.168 10 4.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2 lg:p-4">
                <iframe width="100%" height="450" src="https://www.youtube.com/embed/CE9KAWza058" title="Video Profile of Nepal Environmental Treks &amp; Expedition" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen
                    style="box-shadow:  4rem 4rem 0 -2rem #f3f4f6, 4rem 4rem #d3d7de">
                </iframe>
            </div>

        </div>
    </div>
    {{-- Why Travel with us --}}

    <!-- Blog -->
    <div class="py-20 blog">
        <div class="container">

            <div class="flex justify-center">
                <h2 class="relative px-10 mb-16 text-4xl font-bold text-center text-gray-600 font-display">
                    Latest travel blog
                    <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                </h2>
            </div>

            <div class="grid gap-10 mb-10 lg:grid-cols-3">
                @forelse ($blogs as $blog)
                    <a href="{{ route('front.blogs.show', $blog->slug) }}">
                        <div class="article">
                            <img src="{{ $blog->imageUrl }}" alt="{{ $blog->image_alt }}" loading="lazy" class="rounded-t-lg">
                            <div class="flex items-center mt-6 mb-2 text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ formatDate($blog->blog_date) }}
                            </div>
                            <h3 class="mb-4 text-xl font-display">{{ $blog->name }}</h3>
                            <div class="prose">
                                <p>
                                    {{ truncate(strip_tags($blog->description)) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                @endforelse
            </div>
            <div class="text-center">
                <a href="{{ route('front.blogs.index') }}" class="btn btn-primary">Go to blog</a>
            </div>
        </div>
    </div><!-- Blog -->
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#select-trip-departure-filter").on('change', function(event) {
                event.preventDefault();
                let url = "{!! route('front.trip-departures.filter') !!}";
                let e = $(this);
                let month = e.children("option:selected").val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        month: month
                    },
                    async: false,
                    success: function(response) {
                        if (response.data != "") {
                            $("#departure-card-block").html(response.data);
                        } else {
                            $("#departure-card-block").html('No data to show.');
                        }
                    }
                });
            });

            $("#banner-slider>.slide").each(function(i, v) {
                let img = new Image();
                let image_src = $(v).find('img').data('img');
                img.onload = function() {
                    $(v).find('img').attr('src', image_src);
                }
                img.src = image_src;
                if (img.complete) img.onload();
            });

            const monthSlider = tns({
                container: '.trips-month-slider',
                nav: false,
                controlsContainer: '.trips-month-slider-controls',
                autoplay: true,
                autoplayButtonOutput: false
            })
        });
    </script>
@endpush
