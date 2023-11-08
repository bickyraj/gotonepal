<?php
$mapImageUrl = $trip->mapImageUrl;
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>
@extends('layouts.front_inner')
@section('meta_og_title'){!! $trip->trip_seo->meta_title ?? '' !!}@stop
@section('meta_description'){!! $trip->trip_seo->meta_description ?? '' !!}@stop
@section('meta_keywords'){!! $trip->trip_seo->meta_keywords ?? '' !!}@stop
@section('meta_og_url'){!! $trip->trip_seo->canonical_url ?? '' !!}@stop
@section('meta_og_description'){!! $trip->trip_seo->meta_description ?? '' !!}@stop
@section('meta_og_image'){!! $trip->trip_seo->ogImageUrl ?? '' !!}@stop
    @push('styles')
        <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.23/dist/fancybox/fancybox.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
        <style>
            .blocker {
                z-index: 10000 !important;
            }

            .embed-container {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
                overflow: hidden;
                max-width: 100%;
            }

            .embed-container iframe,
            .embed-container object,
            .embed-container embed {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
        <style type="text/css">
            .modal {
                z-index: 99999 !important;
            }

            .map-image-modal {
                cursor: zoom-in;
                object-fit: cover;
                /*width: 200px;*/
            }

            .trip-faq-description ul li {
                list-style-type: inherit !important;
            }

            .modal-body {
                /* 100% = dialog height, 120px = header + footer */
                /*height: 70vh;*/
                /*overflow-y: scroll;*/
            }

            .trip-map-iframe {
                display: flex;
            }
        </style>
    @endpush
@section('content')

    <!-- Hero -->
    <section class="relative hero">
        <div id="hero-slider" class="hero-slider">
            @if (iterator_count($trip->trip_galleries))
                @foreach ($trip->trip_galleries as $gallery)
                    <div class="slide">
                        <img src="{{ $gallery->imageUrl }}" class="block w-full object-cover h-96 md:h-[36rem] lg:h-[48rem]" alt="">
                    </div>
                @endforeach
            @endif
        </div>

        <div class="absolute w-full py-20 overlay">
            <div class="container flex flex-wrap items-end gap-20">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-white lg:text-6xl">
                        <span>{{ $trip->name }}</span>
                    </h1>

                    <div class="hidden breadcrumb-wrapper md:block">
                        <nav aria-label="breadcrumb">
                            <ol class="flex-wrap text-white breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('front.trips.listing') }}">Trips</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $trip->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="hidden ratings-wrapper lg:block">
                    <div class="px-6 py-4 text-white rounded ratings d-flex align-items-center bg-primary text-secondary ">
                        <div class="flex">
                            @for ($i = 0; $i < $trip->rating; $i++)
                                <svg class="w-6 h-6 text-accent">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                </svg>
                            @endfor

                            @for ($i = 0; $i < 5 - $trip->rating; $i++)
                                <svg class="w-6 h-6 text-accent" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-width="1.5"
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                        </div>
                        <div class="text-sm text-center">from {{ $trip->reviews_count }} reviews</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute hidden hero-slider-controls md:block">
            <div class="container flex gap-2">
                <button>
                    <svg class="w-5 h-5">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                    </svg>
                </button>
                <button>
                    <svg class="w-5 h-5">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </button>
            </div>
        </div>

    </section>

    <section class="bg-gray">
        <!-- Sticky Nav -->
        <div class="sticky top-0 z-10 shadow bg-light tdb">
            <div class="container flex items-center justify-between">
                <nav class="flex items-center justify-center tour-details-tabs" id="secondnav">
                    <ul class="flex flex-wrap bg-white nav">
                        <li class="border-l border-r border-light">
                            <a href="#overview" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                <svg class="w-6 h-6 text-gray group-hover:text-white">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viewgrid" />
                                </svg>
                                <span class="hidden text-sm md:block">Overview</span>
                            </a>
                        </li>

                        @if (!$trip->trip_itineraries->isEmpty())
                            <li class="border-r border-light">
                                <a href="#itinerary" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                    <svg class="w-6 h-6 text-gray group-hover:text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#clock" />
                                    </svg>
                                    <span class="hidden text-sm md:block">Itinerary</span>
                                </a>
                            </li>
                        @endif

                        @if ($trip->trip_include_exclude)
                            <li class="border-r border-light">
                                <a href="#inclusions" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                    <svg class="w-6 h-6 text-gray group-hover:text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#archive" />
                                    </svg>
                                    <span class="hidden text-sm md:block">Inclusions</span>
                                </a>
                            </li>
                        @endif

                        @if (!$trip->trip_departures->isEmpty())
                            <li class="border-r border-light">
                                <a href="#date-price" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                    <svg class="w-6 h-6 text-gray group-hover:text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#calendar" />
                                    </svg>
                                    <span class="hidden text-sm md:block">Date & Price</span>
                                </a>
                            </li>
                        @endif

                        <li class="border-r border-light">
                            <a href="#reviews" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                <svg class="w-6 h-6 text-gray group-hover:text-white">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#chat" />
                                </svg>
                                <span class="hidden text-sm md:block">Review</span>
                            </a>
                        </li>

                        @if ($trip->trip_seo->about_leader)
                            <li class="border-r border-light">
                                <a href="#equipment-list" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                    <svg class="w-6 h-6 text-gray group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                                        </path>
                                    </svg>
                                    <span class="hidden text-sm md:block">Equipment List</span>
                                </a>
                            </li>
                        @endif

                        @if (!$trip->trip_faqs->isEmpty())
                            <li class="border-r border-white">
                                <a href="#faqs" class="flex flex-col items-center gap-1 px-4 py-2 lg:px-10 hover:bg-accent hover:text-white group">
                                    <svg class="w-6 h-6 text-gray group-hover:text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#questionmarkcircle" />
                                    </svg>
                                    <span class="hidden text-sm md:block">FAQs</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
                <a href="" class="items-center hidden gap-2 px-4 py-2 text-sm text-white rounded-lg lg:flex bg-primary hover:bg-primary-dark">
                    <svg class="w-6 h-6" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 448 448">
                        <path fill="#fff"
                            d="M223.9 406.7c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 327.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6Z" />
                        <path fill="#28d146" fill-rule="nonzero"
                            d="M380.9 65.1C339 23.1 283.2 0 223.9 0 101.5 0 1.9 99.6 1.9 222c0 39.1 10.2 77.3 29.6 111L0 448l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157Zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 327.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6Zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6Z" />
                    </svg>Chat with us
                </a>
            </div>
            <div id="tourDetailsBarIO"></div>
        </div><!-- Sticky Nav -->

        <div class="container py-20">

            <div class="grid gap-2 lg:grid-cols-3 xl:grid-cols-4 lg:gap-10">

                <div class="relative tour-details lg:col-span-2 xl:col-span-3">

                    <div class="lg:hidden">
                        @include('front.elements.price_card')
                    </div>

                    <div id="overview" class="px-4 py-10 mb-4 bg-white tds lg:px-10">
                        <div>

                            <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#calendarduration" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Duration
                                        </div>
                                        <div>
                                            {{ $trip->duration }} days
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#maxelevation" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Max. Elevation
                                        </div>
                                        <div>
                                            {{ $trip->max_altitude }}m
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#groupsize" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Group size
                                        </div>
                                        <div>
                                            {{ $trip->group_size }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#level" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Level
                                        </div>
                                        <div>
                                            {{ $trip->difficulty_grade_value }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#transportation" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Transportation
                                        </div>
                                        <div>
                                            {{ $trip->trip_info->transportation ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#bestseason" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Best Season
                                        </div>
                                        <div>
                                            {{ $trip->trip_info->best_season ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#accomodation" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Accomodation
                                        </div>
                                        <div>
                                            {{ $trip->trip_info->accomodation ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#meals" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Meals
                                        </div>
                                        <div>
                                            {{ $trip->trip_info->meals ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#startsat" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Starts at
                                        </div>
                                        <div>
                                            {{ $trip->starting_point }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex table-item aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#endsat" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Ends at
                                        </div>
                                        <div>
                                            {{ $trip->ending_point }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex p-4 rounded-lg aic lg:col-span-3 bg-light">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-primary">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#triproute" />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-sm font-bold text-gray">
                                            Trip Route
                                        </div>
                                        <div>
                                            {{ $trip->trip_info->trip_route ?? '' }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="px-3">

                                <h2 class="mb-2 text-2xl font-display text-primary">Highlights</h2>
                                <ul class="mb-4 highlights">
                                    {!! $trip->trip_info ? $trip->trip_info->highlights : '' !!}
                                </ul>

                                <div id="overview-text" x-data="{ expanded: false }" class="relative mb-4">
                                    <h2 class="sr-only">Overview</h2>
                                    <div x-show="expanded" class="pb-20" x-collapse.min.200px><?= $trip->trip_info ? $trip->trip_info->overview : '' ?></div>
                                    <div class="absolute bottom-0 flex justify-center w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button
                                            class="px-4 py-2 text-xs rounded-full bg-light" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
                                </div>

                                <div class="p-4 mb-3 bg-light">
                                    <h3 class="mb-2 text-xl font-display text-primary"> Important Note</h3>
                                    <p class="mb-0 text-sm">
                                        {!! $trip->trip_info ? $trip->trip_info->important_note : '' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="itinerary" class="px-4 py-10 mb-4 bg-white tds lg:px-10" x-data="{
                        day1Open: true,
                        @for ($i = 1; $i < $trip->trip_itineraries->count() ; $i++)
                        day{{ $i + 1 }}Open:false, @endfor
                    }">
                        <div class="flex flex-wrap items-end justify-between mb-4">
                            <h2 class="text-3xl font-display text-primary">Trip Itinerary</h2>
                            <div>
                                <button class="mb-2 btn btn-sm btn-primary expand-all"
                                    @click="
                                @for ($i = 0; $i < $trip->trip_itineraries->count() ; $i++)
                                    day{{ $i + 1 }}Open = @endfor
                                true">Expand
                                    All</button>
                                <button class="mb-2 btn btn-sm btn-primary collapse-all"
                                    @click="
                                @for ($i = 0; $i < $trip->trip_itineraries->count() ; $i++)
                                    day{{ $i + 1 }}Open = @endfor
                                false">Collapse
                                    All</button>
                            </div>
                        </div>
                        <div class="mb-4 itinerary">
                            @foreach ($trip->trip_itineraries as $i => $itinerary)
                                <div class="mb-2 border-light">
                                    <button class="flex items-center w-full p-2 text-left text-primary" :aria-expanded="day{{ $i + 1 }}Open" aria-controls="day{{ $i + 1 }}"
                                        @click="day{{ $i + 1 }}Open=!day{{ $i + 1 }}Open">
                                        <div class="flex items-center mr-4">
                                            <div class="mr-2 text-sm">Day</div>
                                            <div class="text-2xl font-display text-primary">
                                                {{ $itinerary->day }}
                                            </div>
                                        </div>
                                        <div class="flex justify-between flex-grow-1">
                                            <h3 class="text-xl font-display">{{ $itinerary->name }}</h3>
                                            <svg class="flex-shrink-0 w-6 h-6" x-show="!day{{ $i + 1 }}Open">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#plus" />
                                            </svg>
                                            <svg class="flex-shrink-0 w-6 h-6" x-show="day{{ $i + 1 }}Open">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#minus" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div id="day{{ $i + 1 }}" class="border-top-light" x-cloak x-show.transition="day{{ $i + 1 }}Open">
                                        <div class="{{ isset($itinerary->image_name) && !empty($itinerary->image_name) ? 'grid gap-4 xl:grid-cols-2' : '' }}">
                                            @if (isset($itinerary->image_name) && !empty($itinerary->image_name))
                                                <div class="p-4 {{ $i % 2 == 0 ? 'xl:order-1' : '' }}">
                                                    <a href="{{ $itinerary->imageUrl }}" data-fancybox="itinerary-days" data-caption="Day {{ $itinerary->day }}">
                                                        <img src="{{ $itinerary->imageUrl }}" alt="" class="object-cover w-full h-full" loading="lazy">
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="p-4">
                                                <p>
                                                    {!! $itinerary->description !!}
                                                </p>
                                            </div>
                                        </div>
                                        {{-- icons --}}
                                        @if ($itinerary->max_altitude || $itinerary->accomodation || $itinerary->meals)
                                            <div class="flex flex-col justify-between gap-4 bg-gray md:flex-row">
                                                @if ($itinerary->max_altitude)
                                                    <div class="flex gap-2 p-4">
                                                        <img src="{{ asset('assets/front/img/elevation.png') }}" alt="" class="w-10 h-10" loading="lazy">
                                                        <div>
                                                            <h4 class="text-sm font-bold">Max. altitude</h4>
                                                            <div>{{ $itinerary->max_altitude }}m</div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($itinerary->accomodation)
                                                    <div class="flex gap-2 p-4">
                                                        <img src="{{ asset('assets/front/img/accomodation.png') }}" alt="" class="w-10 h-10" loading="lazy">
                                                        <div>
                                                            <h4 class="text-sm font-bold">Accomodation</h4>
                                                            <div>{{ $itinerary->accomodation }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($itinerary->meals)
                                                    <div class="flex gap-2 p-4">
                                                        <img src="{{ asset('assets/front/img/meal.png') }}" alt="" class="w-10 h-10" loading="lazy">
                                                        <div>
                                                            <h4 class="text-sm font-bold">Meals</h4>
                                                            <div>{{ $itinerary->meals }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="items-center justify-between p-4 lg:flex bg-light">
                            <div>
                                Not satisfied with this itinerary? <b class="text-primary">Make your own</b>.
                            </div>
                            <a href="{{ route('front.plantrip.createfortrip', $trip->slug) }}" class="btn btn-sm btn-primary">Plan My Trip</a>
                        </div>
                    </div>

                    @if ($canMakeChart)
                        <div class="px-4 py-10 mb-4 bg-white tds lg:px-10">
                            <canvas id="ctx"></canvas>
                        </div>
                    @endif

                    @push('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.23/dist/fancybox/fancybox.umd.min.js"></script>
                        <script>
                            Fancybox.bind("[data-fancybox]", {});
                        </script>
                        @if ($canMakeChart)
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
                            <script>
                                const ctx = document.getElementById('ctx');

                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: [{{ implode(',', range(1, count($elevations))) }}],
                                        datasets: [{
                                            label: 'Max. elevation',
                                            data: [{{ implode(',', $elevations) }}],
                                            borderWidth: 2
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        @endif
                    @endpush

                    @if (iterator_count($trip->trip_sliders))
                        <div id="galleries" class="mb-4">
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($trip->trip_sliders as $trip_slider)
                                    <a href="{{ $trip_slider->imageUrl }}" data-fancybox="gallery">
                                        <img src="{{ $trip_slider->imageUrl }}" loading="lazy">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div id="inclusions" class="px-4 py-10 mb-4 bg-white tds lg:px-10">
                        <div class="p-3 bg-white">
                            @if ($trip->trip_include_exclude)
                                <div class="grid gap-1 lg:grid-cols-2">
                                    <div>
                                        <h2 class="text-3xl font-display text-primary">Includes</h2>
                                        <ul class="includes">
                                            <?= $trip->trip_include_exclude->include ?>
                                        </ul>
                                    </div>

                                    <div>
                                        <h2 class="text-3xl font-display text-primary">Doesn't Include</h2>
                                        <ul class="excludes">
                                            <?= $trip->trip_include_exclude->exclude ?>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (!$trip->trip_departures->isEmpty())
                        <div id="date-price" class="px-4 py-10 mb-4 bg-white lg:px-10">
                            <h2 class="text-3xl font-display text-primary">Upcoming Departure Dates</h2>
                            <div class="table-wrapper-scroll">
                                <table class="table mb-2">
                                    <thead>
                                        <th class="text-left upper">{{ $trip->name }}</th>
                                        <th class="text-left upper">Price</th>
                                        <th class="text-left upper">Seats Left</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        @foreach ($trip->trip_departures as $departure)
                                            <tr>
                                                <td>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-6 h-6 mr-1 text-primary">
                                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}" />
                                                        </svg>
                                                        {{ formatDate($departure->from_date) }} — {{ formatDate($departure->to_date) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-6 h-6 mr-1 text-primary">
                                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#tag') }}" />
                                                        </svg>
                                                        <div>
                                                            <small class="text-gray"><s>USD {{ number_format($trip->cost) }}</s></small><br>
                                                            <span class="text-green">USD <b>{{ number_format($departure->price) }}</b></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-6 h-6 mr-1 text-primary">
                                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#users') }}" />
                                                        </svg>
                                                        {{ $departure->seats }}
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('front.trips.departure-booking', ['slug' => $trip->slug, 'id' => $departure->id]) }}" class="btn btn-sm btn-accent">Join
                                                        Group</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- <p class="text-center"><button id="more-dates" class="btn btn-sm btn-gray">See more dates</button></p> -->
                            </div>
                        </div>
                    @endif

                    @if (iterator_count($trip->trip_reviews))
                        <div id="reviews" class="px-4 py-10 mb-4 bg-white tds lg:px-10">
                            <div class="items-center justify-between mb-4 lg:flex">
                                <h2 class="text-3xl font-display text-primary">Reviews
                                </h2>

                                <div>
                                    <a href="{{ route('front.reviews.create') }}" class="mr-1 btn btn-primary btn-sm" data-toggle="modal" data-target="#review-modal">
                                        Write a review</a>
                                </div>
                            </div>
                            <div class="grid gap-10 mb-10">
                                @foreach ($trip->trip_reviews()->where('status', 1)->get() as $review)
                                    <div class="review">
                                        <div class="review__content">
                                            <h3 class="mb-2 text-2xl font-display text-primary">{{ $review->title }}</h3>
                                            <div class="mb-4 prose">
                                                <p>{{ $review->review }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-6">
                                            <img src="{{ $review->thumbImageUrl }}" alt="" loading="lazy">
                                            <div>
                                                <div class="font-bold">{{ $review->review_name }}</div>
                                                <div class="text-sm text-gray">{{ $review->review_country }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center">
                                <a href="{{ route('front.reviews.index') }}" class="btn btn-sm btn-primary">See more reviews
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- Equipment List --}}
                    @if ($trip->trip_seo->about_leader)
                        <div id="equipment-list" class="px-4 py-10 mb-4 bg-white tds lg:px-10">
                            <h2 class="mb-4 text-3xl font-display text-primary">Equipment List</h2>
                            <div class="prose">
                                {!! $trip->trip_seo->about_leader !!}
                            </div>
                        </div>
                    @endif
                    {{-- Equipment List --}}

                    @if (!$trip->trip_faqs->isEmpty())
                        <div id="faqs" class="px-4 py-10 mb-4 bg-white tds lg:px-10">
                            <h2 class="mb-4 text-3xl font-display text-primary">Frequently Asked Questions</h2>

                            <div class="mb-4" x-data="{ active: 'none' }">
                                @foreach ($trip->trip_faqs as $i => $faq)
                                    <div class="border-light">
                                        <button class="flex items-center justify-between w-full py-2 text-left " @click="active = (active === {{ $i }} ? 'none' : {{ $i }})">
                                            <h3 class="text-xl font-display text-primary">{{ $faq->title }}</h3>

                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-light">
                                                <svg class="flex-shrink-0 w-6 h-6 text-primary" x-show="active!=={{ $i }}">
                                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#plus" />
                                                </svg>
                                                <svg class="flex-shrink-0 w-6 h-6 text-primary" x-show="active==={{ $i }}">
                                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#minus" />
                                                </svg>
                                            </div>
                                        </button>
                                        <div class="py-4" x-cloak x-show.transition="active==={{ $i }}">
                                            <div class="py-10 mb-0 prose border-t border-gray-600">
                                                {!! $faq->description !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <a href="#" class="mb-2 btn btn-primary btn-sm">Read more FAQs</a>
                        </div>
                    @endif


                    <div class="flex flex-wrap justify-between mb-4">
                        <div class="flex mb-2">
                            <a href="" class="mr-2 btn btn-accent">Book Now</a>
                            <a href="" class="btn btn-primary">
                                <svg class="w-6 h-6 mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#adjustments" />
                                </svg>
                                Plan My Trip
                            </a>
                        </div>

                        <div class="flex">
                            <a href="" class="flex items-center p-1 mr-2 text-accent" title="Print tour details">
                                <svg class="flex-shrink-0 w-6 h-6 mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#printer" />
                                </svg>
                                <span>Print Tour Details</span>
                            </a>
                            <a href="#" class="flex items-center p-1 text-accent" title="">
                                <svg class="flex-shrink-0 w-6 h-6 mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#download" />
                                </svg>
                                <span>Download Tour Brochure</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h2 class="mb-2 uppercase lg:text-xl font-display text-primary">Share this tour</h2>
                        <div class="flex gap-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.trips.show', ['slug' => $trip->slug]) }}" class="mr-2 text-primary hover:text-accent">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ route('front.trips.show', ['slug' => $trip->slug]) }}&text=" class="mr-2 text-primary hover:text-accent">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                                </svg>
                            </a>
                            <a href="{{ Setting::get('instagram') }}" class="text-primary hover:text-accent">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- aside --}}
                <aside>
                    @include('front.elements.price_card')

                    <a href="" class="w-full mb-8 btn btn-primary">Ask for agency price</a>

                    @include('front.elements.enquiry')

                    <!-- Route Map -->
                    @if ($trip->map_file_name)
                        <div class="mb-8">
                            <div class="card-header">
                                <h2 class="mb-2 text-2xl font-display text-primary">Map & Route</h2>
                            </div>
                            <div class="p-0 card-body">
                                <!-- Link to open the modal -->
                                <a href="#ex1" rel="modal:open">
                                    <img class="img-fluid" src="{{ $trip->mapImageUrl }}" alt="{{ $trip->name }}" loading="lazy">
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (!empty($trip->iframe))
                        <div class="mb-8">
                            <div class="card-header">
                                <h2 class="mb-2 text-2xl uppercase font-display text-primary">Map</h2>
                            </div>
                            <div class="p-0 card-body">
                                <!-- Link to open the modal -->
                                <div class="trip-map-iframe">
                                    {!! $trip->iframe !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-10">
                        @include('front.elements.experts-card')
                    </div>


                    @include('front.elements.essential_trip_information')

                    @if (iterator_count($trip->addon_trips))
                        <div class="mb-8">
                            <h2 class="mb-2 text-2xl uppercase font-display text-primary">Additional Tours</h2>
                            @forelse ($trip->addon_trips as $addon_trip)
                                @include('front.elements.addon_trip', ['trip' => $addon_trip])
                            @empty
                            @endforelse
                        </div>
                    @endif

                    <div class="sticky hidden lg:block top-20">
                        @include('front.elements.price_card')
                    </div>

                </aside>
            </div>
        </div>

        <!-- Similar -->
        @if (!$trip->similar_trips->isEmpty())
            <div class="py-10 bg-light ">
                <div class="container">
                    <h2 class="text-4xl lg:text-5xl font-display text-primary">Similar Tours</h2>
                    <div class="grid gap-2 md:grid-cols-2 lg:grid-cols-3 md:gap-4">
                        @forelse ($trip->similar_trips as $trip)
                            @include('front.elements.tour-card', ['tour' => $trip])
                        @empty
                        @endforelse
                    </div>
                </div>
            </div> <!-- Similar -->
        @endif
    </section>

    {{-- trips of the month
    <div class="py-10 text-white bg-primary">
        <div class="container">

            <div class="items-center justify-between mb-4 lg:flex">
                <h1 class="text-4xl lg:text-5xl font-display">Trips of the month
                </h1>

                <div class="trips-month-slider-controls">
                    <button>
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowleft" />
                        </svg>
                    </button>
                    <button>
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    --}}
    <div class="fixed bottom-0 left-0 right-0 px-4 py-2 bg-white shadow-sm lg:hidden">
        <a href="" class="w-full mb-2 btn btn-primary">Book Now</a>
    </div>

    <div id="ex1" class="modal" style="max-width: 70%;">
        <p>
            <img class="map-image-modal" src="{{ $trip->mapImageUrl }}" alt="route map of {{ $trip->name }}" loading="lazy">
        </p>
    </div>

    {{-- scroll to top --}}
    @include('front.elements.scroll-to-top')
@endsection
@push('scripts')
    <!--<script src="{{ asset('assets/front/js/tour-details.js') }}"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/wheelzoom@4.0.1/wheelzoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.23/dist/fancybox/fancybox.umd.min.js"></script>

    <script>
        wheelzoom(document.querySelector('.wheelzoom'))
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const heroSlider = tns({
                container: '.hero-slider',
                nav: false,
                controlsContainer: '.hero-slider-controls > div',
                autoplay: true,
                autoplayButtonOutput: false
            })

            // For scrollspy functionality
            const tdb = document.querySelector('.tdb')
            if (tdb) {
                const sections = document.querySelectorAll('.tds')
                const sectionScrollObserver = new IntersectionObserver((entries, observer) => {
                    if (entries) {
                        entries.forEach(entry => {
                            const link = tdb.querySelector(`[href="#${entry.target.id}"]`)
                            if (link != null) {
                                if (entry.isIntersecting) {
                                    link.classList.add('bg-primary', 'text-white')
                                    link.querySelector('svg').classList.remove('text-gray')
                                    link.querySelector('svg').classList.add('text-white')
                                } else {
                                    link.classList.remove('bg-primary', 'text-white')
                                    link.querySelector('svg').classList.remove('text-white')
                                    link.querySelector('svg').classList.add('text-gray')
                                }
                            }
                        })
                    }
                }, {
                    rootMargin: "-19% 0px -80% 0px"
                })
                sections.forEach(section => {
                    sectionScrollObserver.observe(section)
                })
            }

        })

        window.onload = function() {

            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            // Hero Slider
            //   $(".tour-details-hero .owl-carousel").owlCarousel({
            //     items: 1,
            //     dots: false,
            //     // autoplay: true,
            //     // autoplayTimeout: 8000,
            //     loop: true,
            //     animateOut: 'fadeOut'
            //   });

            // $("#review-modal").modal('show');

            //Display user image upon select
            const showImage = (src, target) => {
                var fr = new FileReader();
                // when image is loaded, set the src of the image where you want to display it
                fr.onload = function(e) {
                    target.src = this.result;
                };
                src.addEventListener("change", function() {
                    // fill fr with image data
                    fr.readAsDataURL(src.files[0]);
                });
            }
            const src = document.getElementById("photo-input");
            const target = document.getElementById("write-review-photo");
            //   showImage(src, target);

            //Control ratings
            //   const stars = document.querySelectorAll('.select-ratings i')
            //   const ratingsInput = document.querySelector('#ratings-input')
            //   stars.forEach((star, index) => {
            //     star.addEventListener('click', () => {
            //       ratingsInput.value = index + 1
            //       console.log(ratingsInput.value)
            //       stars.forEach((star, indexx) => {
            //         star.classList.remove('active')
            //         if (indexx <= index) star.classList.add('active')
            //       })
            //     })
            //   })
        }

        $(function() {
            $('#ex1').on($.modal.OPEN, function(event, modal) {
                setTimeout(function() {
                    $('.map-image-modal').attr('src', "{{ $mapImageUrl }}");
                    $('.map-image-modal').show();
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });

            $('#ex1').on($.modal.AFTER_CLOSE, function(event, modal) {
                $('.map-image-modal').attr('src', "");
                $('.map-image-modal').hide();
                $('.map-image-modal').trigger('wheelzoom.reset');
            });
            $('#map-modal').on('show.bs.modal', function(e) {
                setTimeout(function() {
                    let img = '<img class="img-fluid map-image-modal" src="{{ $mapImageUrl }}" alt="">';
                    $("#map-modal").find(".modal-body").html(img);
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });
            // $(".similar-trip-rating").rating();
            // $("#review-rating").rating();
        });
    </script>

    <script>
        $(function() {
            var enquiry_validator = $("#enquiry-form").validate({
                ignore: "",
                rules: {
                    'name': 'required',
                    'email': 'required',
                    'country': 'required',
                    'phone': 'required',
                    'message': 'required',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.flex'));
                    // error.append(element.closest('.form-group'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $(form).find('#redirect-url').val('{!! route('front.trips.show', $trip->slug) !!}');
                    if (grecaptcha.getResponse(0)) {
                        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        grecaptcha.reset(enquiry_captcha);
                        grecaptcha.execute(enquiry_captcha);
                    }
                },
            });
        });

        function onSubmitReview(token) {
            $("#review-form").submit();
            return true;
        }

        function onSubmitEnquiry(token) {
            $("#enquiry-form").submit();
            return true;
        }

        let enquiry_captcha;
        let review_captcha;
        var CaptchaCallback = function() {
            enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {
                'sitekey': '{!! config('constants.recaptcha.sitekey') !!}'
            });
            // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '{!! config('constants.recaptcha.sitekey') !!}'});
        };
    </script>
@endpush
