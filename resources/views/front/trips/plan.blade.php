<?php
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
$all_selected_destinations = '';

if (isset($selected_destinations) && !empty($selected_destinations)) {
    $all_selected_destinations = $selected_destinations;
}

$selected_trip_id = '';
$selected_trip_name = '';
if (isset($trip) && !empty($trip)) {
    $selected_trip_id = $trip->id;
    $selected_trip_name = $trip->name;
}
?>

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets/front/css/front-search-slider.css') }}">
    <style>
        .step {
            flex-basis: 120px;
            flex-grow: 1;
        }

        .step:not(:first-child)::before {
            content: '';
            position: absolute;
            top: 1.3rem;
            right: 50%;
            width: 100%;
            height: .5rem;
            background-color: #f0f8ff;
            z-index: -1;
        }

        .step.active:not(:first-child)::before {
            background-color: var(--primary);
        }

        .step .step-bg {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 3rem;
            height: 3rem;
            background-color: #f0f8ff;
            border-radius: 100%;
        }

        .step.active .step-bg {
            background-color: var(--primary);
        }

        .step svg {
            color: var(--primary);
        }

        .step.active svg {
            color: white;
        }

        .radio-input,
        .radio-input-compact,
        .check-input {
            opacity: 0;
            position: absolute;
        }

        .radio-input+label {
            position: relative;
            display: flex;
            gap: 1rem;
            align-items: center;
            padding: 2rem 1rem;
            background-color: #f0f8ff;
            cursor: pointer;
        }

        .radio-input+label.col {
            gap: .5rem;
            flex-direction: column;
        }

        .radio-input+label:hover {
            background-color: #d6e0f5;
        }

        .radio-input:checked+label {
            background-color: #709bf0;
            color: white;
        }

        .radio-input:checked+label img {
            filter: brightness(6);
        }

        .radio-input-compact+label {
            position: relative;
            display: flex;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            background-color: #f0f8ff;
            cursor: pointer;
        }

        .radio-input-compact+label svg {
            color: #8080e0;
        }

        .radio-input-compact+label.col {
            gap: .5rem;
            flex-direction: column;
        }

        .radio-input-compact+label:hover {
            background-color: #d6e0f5;
        }

        .radio-input-compact:checked+label {
            background-color: #709bf0;
            color: white;
        }

        .radio-input-compact:checked+label svg {
            color: white;
        }

        .radio-input-compact+label .check {
            fill: #8080e0;
            opacity: 0;
        }

        .radio-input-compact:checked+label .check {
            opacity: 1;
        }

        .check-input+label {
            position: relative;
            display: flex;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            background-color: #f0f8ff;
            cursor: pointer;
        }

        .check-input+label.col {
            gap: .5rem;
            flex-direction: column;
        }

        .check-input+label:hover {
            background-color: #d6e0f5;
        }

        .check-input:checked+label {
            background-color: #709bf0;
            color: white;
        }

        .check-input+label .check {
            fill: #8080e0;
            opacity: 0;
        }

        .check-input:checked+label .check {
            opacity: 1;
        }

        #stepForm>div {
            display: none;
        }

        #stepForm>div:first-of-type {
            display: block;
        }
    </style>
@endpush

@extends('layouts.front_inner')

@section('content')
    <!-- Hero -->
    <section class="relative hero-alt" style="min-height: 200px;">
        <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" style="max-height: 400px;">
        <div class="absolute overlay">
            <div class="container ">
                <h1>Plan My Trip</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Plan My Trip</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-20" x-data="">
        <div class="grid max-w-6xl gap-20 px-4 mx-auto">

            {{-- Progress --}}
            <div id="step-block" class="hidden lg:flex">
                {{-- Mark each step as active if it is complete or current --}}
                <button id="step-who" class="relative flex flex-col items-center flex-grow gap-2 step active">
                    <div class="step-bg">
                        <svg class="w-8 h-8" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                            <g transform="translate(0 -57.3)">
                                <path fill="currentColor" fill-rule="nonzero"
                                    d="M26 79.717c3.932 0 7.166-3.234 7.166-7.165 0-3.932-3.234-7.166-7.165-7.166-3.932 0-7.166 3.234-7.166 7.166 0 3.931 3.234 7.165 7.166 7.165ZM14.785 96.891a2.015 2.015 0 0 1-.662-1.696c.626-6.057 5.79-10.715 11.879-10.715 6.09 0 11.255 4.658 11.88 10.715a2.015 2.015 0 0 1-.661 1.696A16.662 16.662 0 0 1 26 101.214a16.667 16.667 0 0 1-11.216-4.323Z" />
                            </g>
                        </svg>
                    </div> Who
                </button>
                <button id="step-when" class="relative flex flex-col items-center flex-grow gap-2 step">
                    <div class="step-bg">
                        <svg class="w-8 h-8" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                            <g transform="translate(-168.732 -119.946)">
                                <path fill="currentColor"
                                    d="M205.214 166.946H180.2c-3.96 0-7.218-3.259-7.218-7.219v-22.313c0-3.96 3.258-7.218 7.218-7.218h.657v-3.282c0-1.08.888-1.968 1.968-1.968 1.081 0 1.969.888 1.969 1.968v3.282h18.375v-3.282c0-1.08.889-1.968 1.969-1.968s1.969.888 1.969 1.968v3.282h.656c3.96 0 7.219 3.258 7.219 7.218v16.933c2.107 1.447 3.5 3.873 3.5 6.599 0 4.388-3.612 8-8 8a7.96 7.96 0 0 1-5.268-2Zm5.83-13.98v-10.302a3.282 3.282 0 0 0-3.281-3.281H180.2a3.282 3.282 0 0 0-3.281 3.281v17.063a3.282 3.282 0 0 0 3.281 3.281h22.555a7.896 7.896 0 0 1-.273-2.062c0-4.389 3.611-8 8-8 .189 0 .376.006.562.02Zm-4.342 9.26 2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5a.754.754 0 0 0 .143-.441.754.754 0 0 0-.75-.751.752.752 0 0 0-.607.31l-3.483 4.79-1.88-1.88a.752.752 0 0 0-.539-.229.75.75 0 0 0-.521 1.29Zm-23.233-7.749h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.97 1.97 0 0 1-1.969-1.969v-.026c0-1.08.889-1.969 1.969-1.969Zm-1.969-3.281c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.979 1.979 0 0 1-1.969-1.969v-.026Zm17.719 3.281h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.97 1.97 0 0 1-1.969-1.969v-.026c0-1.08.889-1.969 1.969-1.969Zm3.281-8.531c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.979 1.979 0 0 1-1.969-1.969v-.026Zm1.969 3.281h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.97 1.97 0 0 1-1.969-1.969v-.026c0-1.08.889-1.969 1.969-1.969ZM192 156.446c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.979 1.979 0 0 1-1.969-1.969v-.026Zm7.219-12.469h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.97 1.97 0 0 1-1.969-1.969v-.026c0-1.08.889-1.969 1.969-1.969Zm-1.969 7.219c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.979 1.979 0 0 1-1.969-1.969v-.026Zm-3.281-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.97 1.97 0 0 1-1.969-1.969v-.026c0-1.08.889-1.969 1.969-1.969Zm-7.219 1.969c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.979 1.979 0 0 1-1.969-1.969v-.026Zm5.25-5.25c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.979 1.979 0 0 1-1.969-1.969v-.026Zm-3.281 8.531h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.889 1.969-1.969 1.969h-.026a1.97 1.97 0 0 1-1.969-1.969v-.026c0-1.08.889-1.969 1.969-1.969Z" />
                            </g>
                        </svg>
                    </div> When
                </button>
                <button id="step-where" class="relative flex flex-col items-center flex-grow gap-2 step">
                    <div class="step-bg">
                        <svg class="w-8 h-8" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                            <g transform="translate(-57.508 -312.241)">
                                <path fill="currentColor"
                                    d="m82.883 355.25.006.003c.397.173.62.133.62.133s.221.04.62-.133l.017-.008.036-.016a22.693 22.693 0 0 0 2.094-1.156 27.647 27.647 0 0 0 4.587-3.56c3.34-3.22 6.766-8.253 6.766-15.3 0-7.746-6.375-14.12-14.12-14.12-7.747 0-14.122 6.374-14.122 14.12 0 7.045 3.426 12.08 6.768 15.3a27.779 27.779 0 0 0 4.586 3.56c.639.397 1.295.762 1.968 1.097l.125.059.037.016.012.006Zm.625-15.498c2.49 0 4.539-2.05 4.539-4.539s-2.05-4.538-4.539-4.538c-2.49 0-4.539 2.049-4.539 4.538 0 2.49 2.05 4.54 4.54 4.54Z" />
                            </g>
                        </svg>
                    </div>Where
                </button>
                <button id="step-accomodation" class="relative flex flex-col items-center flex-grow gap-2 step">
                    <div class="step-bg">
                        <svg class="w-8 h-8" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                            <g transform="translate(-57.508 -250)">
                                <path fill="currentColor"
                                    d="M69.675 290v.918a3.582 3.582 0 0 1-3.582 3.582h-.003a3.582 3.582 0 0 1-3.582-3.582V290h7.167Zm33.283 0v.876a3.582 3.582 0 0 1-3.582 3.582h-.002a3.582 3.582 0 0 1-3.582-3.582V290h7.166Zm-2.916-2.958h-37.5v-5.922a9.076 9.076 0 0 1 2.75-6.509v-9.916c0-1.765.701-3.457 1.948-4.705a6.656 6.656 0 0 1 4.705-1.948h21.61c1.765 0 3.457.701 4.705 1.948a6.656 6.656 0 0 1 1.948 4.705v9.916l.091.09a9.076 9.076 0 0 1 2.659 6.419v5.922h-2.916Zm-30.75-14.697a9.066 9.066 0 0 1 2.328-.303h22.26c.793 0 1.575.103 2.328.303v-1.676a4.627 4.627 0 0 0-4.627-4.627h-5.662a4.63 4.63 0 0 0-3.169 1.255 4.63 4.63 0 0 0-3.169-1.255h-5.662a4.627 4.627 0 0 0-4.627 4.627v1.676Z" />
                            </g>
                        </svg>
                    </div>Accommodation
                </button>
                <button id="step-budget" class="relative flex flex-col items-center flex-grow gap-2 step">
                    <div class="step-bg">
                        <svg class="w-8 h-8" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                            <g transform="translate(0 -312.241)">
                                <path fill="currentColor"
                                    d="M5 323.312a2.343 2.343 0 0 1 2.333-2.333h37.334A2.343 2.343 0 0 1 47 323.312v18.667a2.343 2.343 0 0 1-2.333 2.333H7.333A2.343 2.343 0 0 1 5 341.98v-18.667Zm28 9.334c0 3.84-3.16 7-7 7s-7-3.16-7-7c0-3.841 3.16-7 7-7s7 3.159 7 7Zm-21 2.333a2.343 2.343 0 0 0 2.333-2.333A2.343 2.343 0 0 0 12 330.312a2.343 2.343 0 0 0-2.333 2.334A2.343 2.343 0 0 0 12 334.979Zm30.333-2.333A2.343 2.343 0 0 1 40 334.979a2.343 2.343 0 0 1-2.333-2.333A2.343 2.343 0 0 1 40 330.312a2.343 2.343 0 0 1 2.333 2.334ZM6.75 347.812a1.76 1.76 0 0 0-1.75 1.75c0 .96.791 1.75 1.75 1.75 10.306 0 20.284 1.407 29.748 4.037 2.592.72 5.252-1.195 5.252-3.957v-1.83a1.76 1.76 0 0 0-1.75-1.75c-.959 0-22.88-.009-33.25 0Z" />
                            </g>
                        </svg>
                    </div>Budget
                </button>
                <button id="step-tailor-made" class="relative flex flex-col items-center flex-grow gap-2 step">
                    <div class="step-bg">
                        <svg class="w-8 h-8" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                            <g transform="translate(-115.016 -312.241)">
                                <path fill="currentColor"
                                    d="m131.257 346.63 2.661-6.655a8.399 8.399 0 0 1 1.867-2.83l14.594-14.59a4.47 4.47 0 0 1 3.164-1.312c2.452 0 4.473 2.02 4.473 4.475a4.483 4.483 0 0 1-1.31 3.164l-14.594 14.59a8.434 8.434 0 0 1-2.833 1.869l-6.651 2.661a1.059 1.059 0 0 1-1.37-1.373Zm-4.077-17.225v20.035a2.637 2.637 0 0 0 2.636 2.637h20.036a2.637 2.637 0 0 0 2.636-2.637v-11.072c0-.869.713-1.582 1.582-1.582a1.59 1.59 0 0 1 1.582 1.582v11.072c0 3.18-2.62 5.8-5.8 5.8h-20.036c-3.182 0-5.8-2.62-5.8-5.8v-20.035c0-3.183 2.618-5.8 5.8-5.8h11.073a1.59 1.59 0 0 1 1.581 1.582 1.59 1.59 0 0 1-1.581 1.582h-11.073a2.637 2.637 0 0 0-2.636 2.636Z" />
                            </g>
                        </svg>
                    </div>Tailor-made
                    tour
                </button>
            </div>

            {{-- Form --}}
            <form id="stepForm">

                {{-- Who --}}
                <div id="step1" class="grid gap-8 py-10" x-data="{ who: null }">
                    <fieldset>
                        <legend class="mb-8 text-lg text-center lg:text-3xl">How are you travelling? <span class="text-red">*</span></legend>
                        <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">
                            <div>
                                <input type="radio" id="solo" x-model="who" name="who" value="solo" class="peer radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="solo">
                                    <svg class="w-20 h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(0 -57.3)">
                                            <path fill="currentColor" fill-rule="nonzero"
                                                d="M26 79.717c3.932 0 7.166-3.234 7.166-7.165 0-3.932-3.234-7.166-7.165-7.166-3.932 0-7.166 3.234-7.166 7.166 0 3.931 3.234 7.165 7.166 7.165ZM14.785 96.891a2.015 2.015 0 0 1-.662-1.696c.626-6.057 5.79-10.715 11.879-10.715 6.09 0 11.255 4.658 11.88 10.715a2.015 2.015 0 0 1-.661 1.696A16.662 16.662 0 0 1 26 101.214a16.667 16.667 0 0 1-11.216-4.323Z" />
                                        </g>
                                    </svg>
                                    Solo
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="couple" x-model="who" name="who" value="couple" class="peer radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="couple">
                                    <svg class="w-20 h-20 " xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-56.199 -57.3)">
                                            <path fill="currentColor" fill-rule="nonzero"
                                                d="M91.004 79.717c3.932 0 7.166-3.234 7.166-7.165 0-3.932-3.234-7.166-7.166-7.166-3.932 0-7.166 3.234-7.166 7.166 0 3.931 3.234 7.165 7.166 7.165ZM79.787 96.891a2.015 2.015 0 0 1-.661-1.696c.625-6.057 5.79-10.715 11.878-10.715 6.09 0 11.255 4.658 11.88 10.715a2.015 2.015 0 0 1-.66 1.696 16.662 16.662 0 0 1-11.22 4.323 16.667 16.667 0 0 1-11.217-4.323ZM73.308 79.717c3.932 0 7.166-3.234 7.166-7.165 0-3.932-3.234-7.166-7.166-7.166-3.931 0-7.165 3.234-7.165 7.166 0 3.931 3.234 7.165 7.165 7.165ZM62.092 96.891a2.015 2.015 0 0 1-.662-1.696c.626-6.057 5.79-10.715 11.878-10.715 2.334 0 4.25.721 6.108 1.906-2.955 3.313-3.848 6.084-4.218 9.999-.06.64.284 1.657 3 4.103-1.572.48-3.22.729-4.89.726a16.667 16.667 0 0 1-11.216-4.323Z" />
                                        </g>
                                    </svg>
                                    Couple
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="family" x-model="who" name="who" value="family" class="peer radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="family">
                                    <svg class="w-20 h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-112.397 -57.3)">
                                            <path fill="currentColor"
                                                d="M148.326 76.632c-3.931 0-7.166-3.235-7.166-7.166 0-3.931 3.235-7.166 7.166-7.166 3.931 0 7.166 3.235 7.166 7.166 0 3.931-3.235 7.166-7.166 7.166Zm1.655 21.708c.293-4.566-2.656-8.718-5.782-10.04 2.003-1.666 3.161-4.942 3.239-7 6.26-.055 12.142 4.752 12.769 10.81a2.014 2.014 0 0 1-.662 1.695c-3.07 2.787-5.418 4.54-9.564 4.535Zm-21.512-21.708c-3.931 0-7.166-3.235-7.166-7.166 0-3.931 3.235-7.166 7.166-7.166 3.931 0 7.166 3.235 7.166 7.166 0 3.931-3.235 7.166-7.166 7.166Zm-1.655 21.708c-4.146.005-6.494-1.748-9.564-4.535a2.014 2.014 0 0 1-.662-1.695c.626-6.058 6.508-10.865 12.769-10.81.077 2.058 1.236 5.334 3.238 7-3.125 1.322-6.074 5.474-5.781 10.04Zm11.582-11.49c-2.688 0-4.9-2.212-4.9-4.9s2.212-4.9 4.9-4.9c2.689 0 4.9 2.212 4.9 4.9s-2.211 4.9-4.9 4.9Zm-7.67 11.744a1.381 1.381 0 0 1-.452-1.16c.428-4.142 3.959-7.327 8.123-7.327s7.696 3.185 8.124 7.327a1.38 1.38 0 0 1-.453 1.16 11.395 11.395 0 0 1-7.672 2.956 11.394 11.394 0 0 1-7.67-2.956Z" />
                                        </g>
                                    </svg>
                                    Family
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="group" x-model="who" name="who" value="group" class="peer radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="group">
                                    <svg class="w-20 h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-168.596 -57.3)">
                                            <path fill="currentColor" fill-rule="nonzero"
                                                d="M194.597 79.717c3.931 0 7.165-3.234 7.165-7.165 0-3.932-3.234-7.166-7.165-7.166-3.932 0-7.166 3.234-7.166 7.166 0 3.931 3.234 7.165 7.166 7.165Zm-9.555-2.388c0 2.62-2.156 4.777-4.777 4.777-2.62 0-4.777-2.157-4.777-4.777s2.157-4.777 4.777-4.777 4.777 2.157 4.777 4.777ZM174.27 94.827a1.857 1.857 0 0 1-.855-1.055 7.132 7.132 0 0 1-.32-2.114c0-3.932 3.236-7.166 7.166-7.166 1.203 0 2.388.303 3.444.881a15.495 15.495 0 0 0-4.55 9.457 5.498 5.498 0 0 0 .06 1.562 11.87 11.87 0 0 1-4.945-1.565Zm35.71 1.563a11.867 11.867 0 0 0 4.943-1.563c.407-.231.712-.609.853-1.055.213-.686.32-1.4.32-2.117 0-3.931-3.234-7.165-7.165-7.165a7.173 7.173 0 0 0-3.445.881 15.489 15.489 0 0 1 4.555 9.459c.053.52.034 1.046-.062 1.562v-.002Zm3.725-19.061c0 2.62-2.157 4.777-4.777 4.777s-4.777-2.157-4.777-4.777 2.157-4.777 4.777-4.777 4.777 2.157 4.777 4.777ZM183.38 96.89a2.015 2.015 0 0 1-.662-1.696c.626-6.057 5.79-10.715 11.879-10.715 6.09 0 11.255 4.658 11.88 10.715a2.015 2.015 0 0 1-.661 1.696 16.662 16.662 0 0 1-11.22 4.323 16.667 16.667 0 0 1-11.216-4.323Z" />
                                        </g>
                                    </svg> Group
                                </label>
                            </div>
                        </div>
                        <div id="who-error"></div>
                    </fieldset>

                    <div class="flex flex-wrap gap-8" x-cloak x-show="who==='family' || who ==='group'">
                        <div class="form-group">
                            <label for="adults">
                                No. of adults <span class="text-red">*</span>
                            </label>
                            <select id="adults" name="no_of_adults" class="form-control">
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="children">
                                No. of children <span class="text-red">*</span>
                            </label>
                            <select id="children" name="no_of_children" class="form-control">
                                <option selected>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-center gap-8 p-10">
                        <button type="button" class="btn btn-accent next">Next</button>
                    </div>
                </div>

                {{-- When --}}
                <div id="step2" class="grid gap-8 py-10" x-data="{ when: null }">
                    <fieldset>
                        <legend class="mb-8 text-lg text-center lg:text-3xl">Arrival date <span class="text-red">*</span>
                        </legend>
                        <div class="grid gap-8 lg:grid-cols-3">
                            <div>
                                <input type="radio" id="exact-date" x-model="when" name="when" value="exact" class="peer radio-input">
                                <label for="exact-date" class="text-gray-600 peer-checked:bg-primary peer-checked:text-white">
                                    <svg class="h-12" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-56.199 -119.946)">
                                            <path fill="currentColor"
                                                d="M71.042 124.946c1.08 0 1.969.888 1.969 1.968v3.282h18.375v-3.282c0-1.08.889-1.968 1.969-1.968s1.969.888 1.969 1.968v3.282h.656c3.96 0 7.219 3.258 7.219 7.218v22.313c0 3.96-3.259 7.219-7.219 7.219H68.417c-3.96 0-7.218-3.259-7.218-7.219v-22.313c0-3.96 3.258-7.218 7.218-7.218h.657v-3.282c0-1.08.888-1.968 1.968-1.968Zm-2.625 14.437a3.282 3.282 0 0 0-3.281 3.281v17.063a3.282 3.282 0 0 0 3.281 3.281H95.98a3.282 3.282 0 0 0 3.281-3.281v-17.063a3.282 3.282 0 0 0-3.281-3.281H68.417Zm9.782 11.536a3.991 3.991 0 0 1 3.973-3.973h.053c2.18 0 3.974 1.793 3.974 3.973v.053c0 2.18-1.794 3.974-3.974 3.974h-.053c-2.18 0-3.973-1.794-3.973-3.974v-.053Z" />
                                        </g>
                                    </svg>
                                    I have exact travel dates.
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="approx-date" x-model="when" name="when" value="approx" class="peer radio-input">
                                <label for="approx-date" class="text-gray-600 peer-checked:bg-primary peer-checked:text-white">
                                    <svg class="h-12" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-112.397 -119.946)">
                                            <g id="approx-date" transform="translate(112.397 119.946)">
                                                <path fill="currentColor" fill-rule="nonzero"
                                                    d="M15.487 34.531a1.98 1.98 0 0 0-1.969 1.969v.026a1.97 1.97 0 0 0 1.969 1.969h.026a1.98 1.98 0 0 0 1.969-1.969V36.5a1.98 1.98 0 0 0-1.969-1.969h-.026Zm3.281-3.281a1.98 1.98 0 0 1 1.969-1.969h.026a1.98 1.98 0 0 1 1.969 1.969v.026a1.98 1.98 0 0 1-1.969 1.969h-.026a1.98 1.98 0 0 1-1.969-1.969v-.026Zm1.969 3.281a1.98 1.98 0 0 0-1.969 1.969v.026a1.97 1.97 0 0 0 1.969 1.969h.026a1.98 1.98 0 0 0 1.969-1.969V36.5a1.98 1.98 0 0 0-1.969-1.969h-.026ZM24.018 26a1.98 1.98 0 0 1 1.969-1.969h.026A1.98 1.98 0 0 1 27.982 26v.026a1.98 1.98 0 0 1-1.969 1.969h-.026a1.98 1.98 0 0 1-1.969-1.969V26Zm1.969 3.281a1.98 1.98 0 0 0-1.969 1.969v.026a1.97 1.97 0 0 0 1.969 1.969h.026a1.98 1.98 0 0 0 1.969-1.969v-.026a1.98 1.98 0 0 0-1.969-1.969h-.026ZM24.018 36.5a1.98 1.98 0 0 1 1.969-1.969h.026a1.98 1.98 0 0 1 1.969 1.969v.026a1.98 1.98 0 0 1-1.969 1.969h-.026a1.98 1.98 0 0 1-1.969-1.969V36.5Zm7.219-12.469A1.98 1.98 0 0 0 29.268 26v.026a1.97 1.97 0 0 0 1.969 1.969h.026a1.98 1.98 0 0 0 1.969-1.969V26a1.98 1.98 0 0 0-1.969-1.969h-.026Zm-1.969 7.219a1.98 1.98 0 0 1 1.969-1.969h.026a1.98 1.98 0 0 1 1.969 1.969v.026a1.98 1.98 0 0 1-1.969 1.969h-.026a1.98 1.98 0 0 1-1.969-1.969v-.026Zm1.969 3.281a1.98 1.98 0 0 0-1.969 1.969v.026a1.97 1.97 0 0 0 1.969 1.969h.026a1.98 1.98 0 0 0 1.969-1.969V36.5a1.98 1.98 0 0 0-1.969-1.969h-.026ZM34.518 26a1.98 1.98 0 0 1 1.969-1.969h.026A1.98 1.98 0 0 1 38.482 26v.026a1.98 1.98 0 0 1-1.969 1.969h-.026a1.98 1.98 0 0 1-1.969-1.969V26Zm1.969 3.281a1.98 1.98 0 0 0-1.969 1.969v.026a1.97 1.97 0 0 0 1.969 1.969h.026a1.98 1.98 0 0 0 1.969-1.969v-.026a1.98 1.98 0 0 0-1.969-1.969h-.026Z" />
                                                <path fill="currentColor"
                                                    d="M13.518 31.25c0-1.08.889-1.969 1.969-1.969h.026c1.08 0 1.969.889 1.969 1.969v.026c0 1.08-.89 1.969-1.97 1.969h-.025a1.979 1.979 0 0 1-1.97-1.969v-.026Z" />
                                                <path fill="currentColor"
                                                    d="M14.844 5a1.98 1.98 0 0 1 1.969 1.969v3.281h18.375V6.969A1.98 1.98 0 0 1 37.156 5a1.98 1.98 0 0 1 1.969 1.969v3.281h.656c3.961 0 7.219 3.258 7.219 7.219V39.78C47 43.742 43.742 47 39.781 47H12.22C8.258 47 5 43.742 5 39.781V17.47c0-3.961 3.258-7.219 7.219-7.219h.656V6.969A1.98 1.98 0 0 1 14.844 5Zm-2.625 14.438a3.282 3.282 0 0 0-3.281 3.28v17.063a3.282 3.282 0 0 0 3.28 3.282h27.563a3.282 3.282 0 0 0 3.282-3.282V22.72a3.282 3.282 0 0 0-3.282-3.282H12.22Z" />
                                            </g>
                                        </g>
                                    </svg> I have approximate travel dates.
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="decide-later" x-model="when" name="when" value="later" class="peer radio-input">
                                <label for="decide-later" class="text-gray-600 peer-checked:bg-primary peer-checked:text-white">
                                    <svg class="h-12" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(0 -119.946)">
                                            <path fill="currentColor"
                                                d="m17.08 154.415-6.542-1.425-1.23 8.032a1.884 1.884 0 0 1-2.138 1.569 1.883 1.883 0 0 1-1.569-2.137l1.515-9.884A1.876 1.876 0 0 1 9.253 149l8.395 1.708a1.883 1.883 0 0 1 1.569 2.137 1.884 1.884 0 0 1-2.137 1.57ZM28.282 133.446v10.625h8.126c1.029 0 1.874.846 1.874 1.875a1.883 1.883 0 0 1-1.874 1.874h-10a1.876 1.876 0 0 1-1.875-1.874v-12.5c0-1.029.847-1.875 1.875-1.875 1.029 0 1.874.846 1.874 1.875Z" />
                                            <path fill="currentColor"
                                                d="M6.42 146.643a21.186 21.186 0 0 1-.012-.697c0-10.972 9.028-20 20-20s20 9.028 20 20c0 10.971-9.028 20-20 20-7.85 0-14.706-4.623-17.971-11.271l.672-4.39 1.786.273c2.007 6.665 8.23 11.578 15.513 11.578 8.882 0 16.19-7.308 16.19-16.19 0-8.882-7.308-16.19-16.19-16.19-8.882 0-16.19 7.308-16.19 16.19 0 .24.004.48.015.717l-3.813-.02Z" />
                                        </g>
                                    </svg>
                                    I will decide later.
                                </label>
                            </div>
                        </div>
                        <div id="when-error"></div>
                    </fieldset>

                    <div class="flex flex-wrap gap-8">
                        <div class="form-group" x-cloak x-show="when==='exact'">
                            <label for="arrival-date">
                                Arrival date <span class="text-red">*</span>
                            </label>
                            <input type="date" name="arrival_date" id="arrival-date">
                        </div>
                        <div class="form-group" x-cloak x-show="when ==='exact'">
                            <label for="departure-date">
                                Departure date <span class="text-red">*</span>
                            </label>
                            <input type="date" name="departure_date" id="departure-date">
                        </div>
                        <div class="form-group" x-cloak x-show="when ==='approx'">
                            <label for="approx-month">
                                Select month <span class="text-red">*</span>
                            </label>
                            <input type="month" name="month" id="approx-month">
                        </div>
                    </div>

                    <div class="flex justify-center gap-8 p-10">
                        <button type="button" class="btn btn-muted back">Back</button>
                        <button type="button" class="btn btn-accent next">Next</button>
                    </div>
                </div>

                {{-- Where --}}
                <div id="step3" class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-8 text-lg text-center lg:text-3xl">Choose your destination <span class="text-red">*</span></legend>
                        <div class="grid gap-8 mb-8 lg:grid-cols-4">
                            @forelse ($destinations as $destination)
                                <div>
                                    <input type="checkbox" id="{{ $destination->name }}" name="destination[]" value="{{ $destination->id }}" class="check-input destination-checkbox">
                                    <label for="{{ $destination->name }}">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                            <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor" />
                                            <path class="check" clip-rule="evenodd" fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z">
                                            </path>
                                        </svg>
                                        {{ $destination->name }}
                                    </label>
                                </div>
                            @empty
                            @endforelse
                        </div>

                        <div>
                            <input type="checkbox" id="not-sure" name="destination[]" value="not-sure" class="check-input">
                            <label for="not-sure">
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                    <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor" />
                                    <path class="check" clip-rule="evenodd" fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z">
                                    </path>
                                </svg>
                                I am not sure!
                            </label>
                        </div>
                        <div id="destination-error"></div>
                    </fieldset>

                    <fieldset>
                        <div class="flex flex-wrap justify-between mb-4">
                            <legend class="text-lg text-center">Choose the trip(s) you are interested in <span class="text-red">*</span></legend>
                        </div>
                        <div id="trips-block" class="grid gap-8 lg:grid-cols-4 ">
                        </div>
                        <div id="trip-interested-error"></div>
                        <div class="flex items-center" style="justify-content: center; margin-top: 50px;">
                            <div id="spinner-block"></div>
                            <button id="show-more" class="btn btn-accent btn-sm" style="display: none; margin-bottom: 50px;">show
                                more</button>
                        </div>
                    </fieldset>

                    <div class="flex justify-center gap-8 p-10">
                        <button type="button" class="btn btn-muted back">Back</button>
                        <button type="button" class="btn btn-accent next">Next</button>
                    </div>
                </div>

                {{-- Accomodation --}}
                <div id="step4" class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-8 text-lg text-center lg:text-3xl">Preferred accomodation standard <span class="text-red">*</span></legend>
                        <div class="grid gap-8 lg:grid-cols-4">
                            <div>
                                <input type="radio" id="basic" name="accomodation" value="solo" class="peer radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="basic">
                                    <svg class="h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(0 -250)">
                                            <path fill="currentColor"
                                                d="m41.454 274.611.091.09a9.076 9.076 0 0 1 2.659 6.419V287H7.796v-5.88a9.076 9.076 0 0 1 2.75-6.509v-9.916c0-1.765.701-3.457 1.948-4.705a6.656 6.656 0 0 1 4.705-1.948h17.602c1.765 0 3.457.701 4.705 1.948a6.656 6.656 0 0 1 1.948 4.705v9.916Zm-23.912-2.569h16.916v-1.373c0-1.252-.559-2.463-1.592-3.348-.946-.811-2.225-1.279-3.563-1.279h-6.606c-1.338 0-2.617.468-3.563 1.279-1.033.885-1.592 2.096-1.592 3.348v1.373ZM16.167 290v.918a3.583 3.583 0 0 1-3.583 3.582h-.002A3.582 3.582 0 0 1 9 290.918V290h7.167ZM43 290v.918a3.582 3.582 0 0 1-3.582 3.582h-.002a3.583 3.583 0 0 1-3.583-3.582V290H43Z" />
                                        </g>
                                    </svg> Basic
                                </label>
                            </div>

                            {{-- <div>
                                <input type="radio" id="comfortable" name="accomodation" value="couple" class="radio-input">
                                <label class="col" for="comfortable">
                                    <img src="{{ asset('assets/front/img/comfortable.svg') }}" class="h-20">
                                    Comfortable
                                </label>
                            </div> --}}

                            <div>
                                <input type="radio" id="luxury" name="accomodation" value="family" class="radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="luxury">
                                    <svg class="h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-57.508 -250)">
                                            <path fill="currentColor"
                                                d="M69.675 290v.918a3.582 3.582 0 0 1-3.582 3.582h-.003a3.582 3.582 0 0 1-3.582-3.582V290h7.167Zm33.283 0v.876a3.582 3.582 0 0 1-3.582 3.582h-.002a3.582 3.582 0 0 1-3.582-3.582V290h7.166Zm-2.916-2.958h-37.5v-5.922a9.076 9.076 0 0 1 2.75-6.509v-9.916c0-1.765.701-3.457 1.948-4.705a6.656 6.656 0 0 1 4.705-1.948h21.61c1.765 0 3.457.701 4.705 1.948a6.656 6.656 0 0 1 1.948 4.705v9.916l.091.09a9.076 9.076 0 0 1 2.659 6.419v5.922h-2.916Zm-30.75-14.697a9.066 9.066 0 0 1 2.328-.303h22.26c.793 0 1.575.103 2.328.303v-1.676a4.627 4.627 0 0 0-4.627-4.627h-5.662a4.63 4.63 0 0 0-3.169 1.255 4.63 4.63 0 0 0-3.169-1.255h-5.662a4.627 4.627 0 0 0-4.627 4.627v1.676Z" />
                                        </g>
                                    </svg> Luxury
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="camping" name="accomodation" value="family" class="radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="camping">
                                    <svg class="h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-115.016 -250)">
                                            <path fill="currentColor"
                                                d="M134.012 293.71a1.998 1.998 0 0 1-1.714.97h-7.478a2 2 0 0 1-1.714-3.03l15.614-25.985-2.783-4.63a1.969 1.969 0 0 1 .673-2.701l.002-.001a1.967 1.967 0 0 1 2.7.674l1.704 2.836 1.705-2.836a1.967 1.967 0 0 1 2.701-.673 1.97 1.97 0 0 1 .674 2.7l-2.783 4.63 15.614 25.987a2 2 0 0 1-1.714 3.03h-7.478a1.998 1.998 0 0 1-1.714-.97l-5.29-8.804a2.001 2.001 0 0 0-3.429 0l-5.29 8.804Zm3.229-17.94.054-.09h-.051a.04.04 0 0 0-.039.036.039.039 0 0 0 .028.043l.008.012Zm7.605-.09h-.051a.04.04 0 0 0-.039.036.039.039 0 0 0 .028.043l.008.012.054-.09Z" />
                                        </g>
                                    </svg> Camping
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="self-booking" name="accomodation" value="family" class="radio-input">
                                <label class="flex flex-col text-gray-600 peer-checked:bg-primary peer-checked:text-white" for="self-booking">
                                    <svg class="h-20" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-172.524 -250)">
                                            <path fill="currentColor"
                                                d="M203.46 286.556v4.176c0 2.939-2.418 5.357-5.357 5.357H184.71c-2.938 0-5.357-2.418-5.357-5.357v-29.464c0-2.939 2.419-5.357 5.357-5.357h13.393c2.939 0 5.357 2.418 5.357 5.357v4.176h-8.652c-2.278 0-4.113 1.769-4.113 3.866v13.38c0 2.097 1.835 3.866 4.113 3.866h8.652Zm-8.035-27.967h-8.036v1.426a1.273 1.273 0 0 0 1.277 1.277h5.482a1.277 1.277 0 0 0 1.277-1.277v-1.426Zm-6.697 33.482h5.357a1.34 1.34 0 1 0 0-2.678h-5.357a1.34 1.34 0 0 0 0 2.678Zm6.08-7.511c-1.14 0-2.118-.82-2.118-1.87v-9.515h25.005v9.515c0 1.05-.978 1.87-2.118 1.87h-20.769Zm1.038-1.827H200a.999.999 0 0 0 0-1.996h-4.154a.999.999 0 0 0 0 1.996Zm0-4.864a.999.999 0 0 0 0 1.996h8.308a.998.998 0 0 0 0-1.996h-8.308Zm-3.156-7.646v-.913c0-1.05.978-1.87 2.118-1.87h20.769c1.14 0 2.118.82 2.118 1.87v.913H192.69Z" />
                                        </g>
                                    </svg> Self booking
                                </label>
                            </div>
                        </div>
                        <div id="accomodation-error"></div>
                    </fieldset>

                    <div class="flex justify-center gap-8 p-10">
                        <button type="button" class="btn btn-muted back">Back</button>
                        <button type="button" class="btn btn-accent next">Next</button>
                    </div>
                </div>

                {{-- Budget --}}
                <div id="step5" class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-4 text-lg text-center lg:text-3xl">Budget range (per person) <span class="text-red">*</span></legend>
                        Budget range slider
                        <div class="custom-slider-container">
                            <div id="slider-range"></div>
                            <input class="price-range-input" type="text" id="amount" name="amount" readonly style="border:0; color:black; font-size:16px;" value="$0 - $10000">
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="mb-4 text-lg text-center lg:text-2xl">Are you flexible with a change in budget?
                            <span class="text-red">*</span>
                        </legend>
                        <div class="grid gap-8 lg:grid-cols-2">
                            <div>
                                <input type="radio" id="flexible" name="flexible" value="solo" class="peer radio-input">
                                <label for="flexible" class="text-gray-600 peer-checked:bg-primary peer-checked:text-white">
                                    <svg class="h-12" g xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(-56.199 -190.677)">
                                            <path fill="currentColor"
                                                d="M61.199 230.677v-21.002c0-1.834 1.57-3.343 3.48-3.343l9.949.003 16.421-6.635a3.75 3.75 0 0 1 4.882 2.072l1.846 4.569h1.258c2.3.001 4.164 1.791 4.164 4v2.681l-2.723-.001 1.073 2.656h1.65v15a4 4 0 0 1-4 4h-34a4.002 4.002 0 0 1-4-4Zm36.305-15-5.05-12.5-27.274 11.019.598 1.48h4.552l17.238-6.964c.825 2.041 3.04 3.074 4.943 2.305l1.883 4.66h3.11Zm-7.154 0-.214-.53a7.805 7.805 0 0 1-3.603-1.68l-5.468 2.209 9.285.001Zm-9.536 6.384v6.231a1.383 1.383 0 0 0 1.385 1.385 1.384 1.384 0 0 0 1.384-1.385v-6.231c0-.367-.146-.719-.405-.979a1.388 1.388 0 0 0-1.958 0c-.26.26-.406.612-.406.979Z" />
                                        </g>
                                    </svg> Yes, I am flexible. Plan the best trip for me.
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="not-flexible" name="flexible" value="couple" class="peer radio-input">
                                <label for="not-flexible" class="text-gray-600 peer-checked:bg-primary peer-checked:text-white">
                                    <svg class="h-12" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 52 52">
                                        <g transform="translate(0 -190.677)">
                                            <path fill="currentColor"
                                                d="M5.485 207.255a4.817 4.817 0 0 0 3.343 1.421l31.287.001a4 4 0 0 1 4 4v3.78l-7.695-.001c-2.973 0-5.42 2.447-5.42 5.421 0 2.973 2.447 5.42 5.42 5.42h7.695v3.581a3.999 3.999 0 0 1-4 4h-29.8c-2.648-.003-4.826-2.181-4.829-4.829l-.001-22.794Zm0-5.436a3.358 3.358 0 0 1 3.343-3.342l23.11.006a4 4 0 0 1 3.999 4v2.68H8.828a3.36 3.36 0 0 1-3.343-3.344Zm31.316 23.772h-.058a3.732 3.732 0 0 1-3.714-3.714 3.733 3.733 0 0 1 3.714-3.715h.058l8.057.001 1.656-.001v7.429h-9.713Zm.657-1.421a2.497 2.497 0 0 0 2.484-2.483 2.496 2.496 0 0 0-2.484-2.484 2.495 2.495 0 0 0-2.483 2.483 2.495 2.495 0 0 0 2.483 2.484Zm0-3.655a1.18 1.18 0 0 1 1.175 1.175 1.18 1.18 0 0 1-1.175 1.175 1.18 1.18 0 0 1-1.174-1.175c0-.644.53-1.175 1.174-1.175Z" />
                                        </g>
                                    </svg> No, that is my maximum and minimum budget.
                                </label>
                            </div>
                        </div>
                        <div id="flexible-error"></div>
                    </fieldset>

                    <div class="flex justify-center gap-8 p-10">
                        <button type="button" class="btn btn-muted back">Back</button>
                        <button type="button" class="btn btn-accent next">Next</button>
                    </div>
                </div>

                {{-- Tailor-made tour --}}
                <div id="step6" class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-2">Trip type you are looking for<span class="text-red">*</span>
                        </legend>
                        <div class="flex gap-1">
                            <div>
                                <input type="radio" id="tailor-made" name="trip_type" value="tailor-made" class="radio-input-compact">
                                <label for="tailor-made">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    Tailor-made
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="type-group" name="trip_type" value="group" class="radio-input-compact">
                                <label for="type-group">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    Group
                                </label>
                            </div>
                        </div>
                        <div id="trip-type-error"></div>
                    </fieldset>

                    <fieldset>
                        <legend class="mb-2">Current phase of trip planning<span class="text-red">*</span>
                        </legend>
                        <div class="flex flex-wrap gap-1">
                            <div>
                                <input type="radio" id="planning" name="plan_phase" value="planning" class="radio-input-compact">
                                <label for="planning">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    I am still planning on my trip.
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="ready" name="plan_phase" value="ready" class="radio-input-compact">
                                <label for="ready">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    I am ready to start.
                                </label>
                            </div>

                            <div>
                                <input type="radio" id="book" name="plan_phase" value="book" class="radio-input-compact">
                                <label for="book">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    I want to book.
                                </label>
                            </div>
                        </div>
                        <div id="plan-phase-error"></div>
                    </fieldset>

                    <div class="grid gap-8 lg:grid-cols-2">
                        <div>
                            <label for="additional-queries" class="mb-2">
                                Any additional queries?
                            </label>
                            <div class="form-group">
                                <textarea id="additional-queries" name="additional_queries" class="form-control"></textarea>
                            </div>
                        </div>
                        <div>
                            <label for="departure-date" class="mb-2">
                                How did you hear about us? <span class="text-red">*</span>
                            </label>
                            <div class="form-group">
                                <select id="departure-date" name="reached_by" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="Blog">Blog</option>
                                    <option value="Club/Association">Club/Association</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Friend Recommendation">Friend Recommendation</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Internet Search">Internet Search</option>
                                    <option value="Lonely Planet Guides">Lonely Planet Guides</option>
                                    <option value="New York Times">New York Times</option>
                                    <option value="Newspaper Article">Newspaper Article</option>
                                    <option value="Online Advertising">Online Advertising</option>
                                    <option value="Past Client">Past Client</option>
                                    <option value="Trade Partners">Trade Partners</option>
                                    <option value="Trade Show">Trade Show</option>
                                    <option value="Trek Leader/Staff Recommended">Trek Leader/Staff Recommended</option>
                                    <option value="Trip Advisor">Trip Advisor</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center gap-8 p-10">
                        <button type="button" class="btn btn-muted back">Back</button>
                        <button type="button" class="btn btn-accent next">Next</button>
                    </div>
                </div>

                {{-- Personal Information --}}
                <div id="step7" class="grid gap-8 py-10">
                    <h2 class="text-lg lg:text-2xl">PERSONAL INFORMATION</h2>
                    <p>Please fill in the form below. Our customer support will get back to you as soon as possible.</p>
                    <div class="grid gap-8 lg:grid-cols-2">
                        <div>
                            <label for="first-name">First Name <span class="text-red">*</span></label>
                            <div class="form-group">
                                <input type="text" id="first-name" name="first_name" class="form-control">
                            </div>
                        </div>
                        <div>
                            <label for="last-name">Last Name <span class="text-red">*</span></label>
                            <div class="form-group">
                                <input type="text" id="last-name" name="last_name" class="form-control">
                            </div>
                        </div>
                        <div>
                            <label for="contact-no">Contact number <span class="text-red">*</span></label>
                            <div class="form-group">
                                <input type="tel" id="contact-no" name="contact_number" class="form-control">
                            </div>
                        </div>
                        <div>
                            <label for="email">Email <span class="text-red">*</span></label>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div>
                            <label for="nationality">Nationality <span class="text-red">*</span></label>
                            <div class="form-group">
                                @include('front.elements.country')
                            </div>
                        </div>
                        <fieldset>
                            <legend>Preferred method of contact<span class="text-red">*</span></legend>
                            <div class="flex flex-wrap gap-1">
                                <div>
                                    <input type="radio" id="method-email" name="contact_method" value="email" class="radio-input-compact">
                                    <label for="method-email">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                            <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                            <circle cx="10" cy="10" r="6" class="check" />
                                        </svg>
                                        Email
                                    </label>
                                </div>

                                <div>
                                    <input type="radio" id="method-phone" name="contact_method" value="phone" class="radio-input-compact">
                                    <label for="method-phone">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                            <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                            <circle cx="10" cy="10" r="6" class="check" />
                                        </svg>
                                        Phone
                                    </label>
                                </div>

                                <div>
                                    <input type="radio" id="method-both" name="contact_method" value="both" class="radio-input-compact">
                                    <label for="method-both">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                            <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor" />
                                            <circle cx="10" cy="10" r="6" class="check" />
                                        </svg>
                                        Both
                                    </label>
                                </div>
                            </div>
                            <div id="contact-method-error"></div>
                        </fieldset>
                    </div>

                    <div>
                        <input type="checkbox" id="privacy-policy" name="privacy_policy">
                        <label for="privacy-policy">
                            I have read and accept the <a href="{{ url('/privacy-policy') }}" class="text-accent">Privacy Policy</a>. <span class="text-red">*</span>
                        </label>
                        <div id="privacy-policy-error"></div>
                    </div>

                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted back">Back</button>
                        <button id="finish-btn" type="button" class="btn btn-accent finish">Finish</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            $(document).on('click', '#make_a_payment_btn', function(ev) {
                ev.preventDefault();
                let btn = $(this);
                btn.prop('disabled', true);
                btn.html('submitting...');
                setTimeout(() => {
                    $("#captcha-form").submit();
                }, 1000);
            });
        });
    </script>
    <script>
        $(function() {
            let currentPage = 1;
            let totalPage;
            let nextPage;
            var currentStep = 1;
            var form = $("#stepForm");
            var validator = form.validate();
            var formSteps = $("#stepForm>div");

            $("#slider-range").slider({
                classes: {
                    "ui-slider": "custom-slider"
                },
                range: true,
                min: 0,
                max: 10000,
                values: [0, 0],
                change: function(event, ui) {
                    performSearch();
                },
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

            $(".destination-checkbox").on('change', async function(event) {
                currentPage = 1;
                $("#trips-block").html("");
                const trips = await getTripsByDestinationID();
                addTripsToDiv(trips);
            });

            function addTripsToDiv(trips) {
                let html = "";
                const selected_trip_id = "{!! $selected_trip_id !!}";
                for (const trip of trips) {
                    html += `<div class="destination-trip">\
                                <input type="checkbox" id="trip${trip.id}" name="trip_interested[]" value="${trip.id}"\
                                    class="check-input">\
                                <label for="trip${trip.id}">\
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"\
                                        aria-hidden="true" class="w-6 h-6">\
                                        <rect x="0" y="0" width="20" height="20"\
                                            fill="white" stroke="currentColor" />\
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd"\
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z">\
                                        </path>\
                                    </svg>\
                                    ${trip.name}\
                                </label>\
                            </div>`;
                }
                $("#trips-block").append(html);
            }

            initDestination();

            function initDestination() {
                const selected_destinations = "{!! $all_selected_destinations !!}";
                if (selected_destinations.length > 0) {
                    const boxes = $(".destination-checkbox");
                    boxes.each(function(i, v) {
                        const dest_id = $(v).val();
                        if (selected_destinations.includes(dest_id)) {
                            $(v).prop('checked', true);
                        }
                    });
                    // get the selected trips and make it selected
                    const selected_trip_id = "{!! $selected_trip_id !!}";
                    const trip_name = "{!! $selected_trip_name !!}";
                    const html = `<div class="destination-trip">\
                                <input type="checkbox" id="trip${selected_trip_id}" checked name="trip_interested[]" value="${selected_trip_id}"\
                                    class="check-input">\
                                <label for="trip${selected_trip_id}">\
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"\
                                        aria-hidden="true" class="w-6 h-6">\
                                        <rect x="0" y="0" width="20" height="20"\
                                            fill="white" stroke="currentColor" />\
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd"\
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z">\
                                        </path>\
                                    </svg>\
                                    ${trip_name}\
                                </label>\
                            </div>`;
                    $("#trips-block").append(html);
                } else {
                    $(".destination-checkbox:first").click();
                }
            }

            $("#show-more").on('click', async function(event) {
                event.preventDefault();
                if (nextPage) {
                    currentPage++;
                    const trips = await getTripsByDestinationID(currentPage);
                    addTripsToDiv(trips);
                    if (!nextPage) {
                        $("#show-more").hide();
                    }
                }
            });

            function getTripsByDestinationID() {
                return new Promise((resolve, reject) => {
                    // get all the selected destination
                    const selectedDestinationArr = [];
                    $('.destination-checkbox:checked').each(function() {
                        selectedDestinationArr.push($(this).val());
                    });
                    let url = '{!! route('front.destinations.gettrips') !!}' + `?ids=${selectedDestinationArr.join(',')}&page=${currentPage}`;
                    let result = [];
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        async: "false",
                        beforeSend: function(xhr) {
                            var spinner =
                                '<button style="margin:0 auto;" class="text-white btn btn-sm btn-primary" type="button" disabled>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Loading Trips...\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </button>';
                            $("#spinner-block").html(spinner);
                            $("#show-more").hide();
                        },
                        success: function(res) {
                            if (res.success) {
                                result = res.data.data;
                                totalPage = res.data.total;
                                currentPage = res.data.current_page;
                                nextPage = (res.data.next_page_url) ? true : false;
                            }
                        }
                    }).done(function(data) {
                        $("#spinner-block").html('');
                        if (!nextPage) {
                            $("#show-more").hide();
                        } else {
                            $("#show-more").show();
                        }
                        resolve(result);
                    });
                });
            }

            const stepBlock = {
                step1: "step-who",
                step2: "step-when",
                step3: "step-where",
                step4: "step-accomodation",
                step5: "step-budget",
                step6: "step-tailor-made",
                step7: "step-tailor-made"
            }

            var validationRules = {
                step1: {
                    who: {
                        required: true
                    },
                    no_of_adults: {
                        required: true
                    },
                    no_of_children: {
                        required: true
                    }
                },
                step2: {
                    when: {
                        required: true
                    },
                    arrival_date: {
                        required: true
                    },
                    departure_date: {
                        required: true
                    },
                    month: {
                        required: true
                    }
                },
                step3: {
                    "destination[]": {
                        required: true
                    },
                    "trip_interested[]": {
                        required: true
                    }
                },
                step4: {
                    accomodation: {
                        required: true
                    }
                },
                step5: {
                    flexible: {
                        required: true
                    }
                },
                step6: {
                    trip_type: {
                        required: true
                    },
                    plan_phase: {
                        required: true
                    },
                    reached_by: {
                        required: true
                    }
                },
                step7: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    contact_number: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    contact_method: {
                        required: true
                    },
                    privacy_policy: {
                        required: true
                    },
                }
            };

            function selectStep(name) {
                const step = $("#step-block>button");
                const index = $(`#${name}`).index();
                step.each(function(i, v) {
                    const el = $(v);
                    if (i <= index) {
                        el.addClass('active');
                    } else {
                        el.removeClass('active');
                    }
                });
            }

            function nextStep() {
                var currentFieldset = formSteps.eq(currentStep - 1);
                const validationGroup = validationRules["step" + currentStep];
                validator.destroy();
                form.validate({
                    rules: validationGroup,
                    errorPlacement: function(error, element) {
                        if (element.attr("name") == "who") {
                            $("#who-error").html(error);
                            // error.insertAfter("#lastname");
                        } else if (element.attr("name") == "when") {
                            $("#when-error").html(error);
                        } else if (element.attr("name") == "destination[]") {
                            $("#destination-error").html(error);
                        } else if (element.attr("name") == "trip_interested[]") {
                            $("#trip-interested-error").html(error);
                        } else if (element.attr("name") == "accomodation") {
                            $("#accomodation-error").html(error);
                        } else if (element.attr("name") == "flexible") {
                            $("#flexible-error").html(error);
                        } else if (element.attr("name") == "trip_type") {
                            $("#trip-type-error").html(error);
                        } else if (element.attr("name") == "plan_phase") {
                            $("#plan-phase-error").html(error);
                        } else if (element.attr("name") == "contact_method") {
                            $("#contact-method-error").html(error);
                        } else if (element.attr("name") == "privacy_policy") {
                            $("#privacy-policy-error").html(error);
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler: function(form) {
                        // console.log();
                        var formData = new FormData($(form)[0]);
                        formData.append('amount', $("#slider-range").slider("values"));
                        // var formData = $(form).serialize();
                        $.ajax({
                            url: "{{ route('front.plantrip.create') }}",
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    location.href = "{{ route('front.plantrip.thank-you') }}";
                                    // form[0].reset();
                                    // $('#cropper-image').attr('src', '{{ asset('img/default.gif') }}');
                                    // if (cropped) {
                                    //   cropper.destroy();
                                    // }
                                    // $('#summernote-description').summernote('reset');
                                }
                            }
                        });
                    }
                });
                // var validationMessagesGroup = validationMessages["step" + currentStep];

                if (form.valid()) {
                    if (currentStep === 7) {
                        form.submit();
                        return;
                    }
                    currentFieldset.hide();
                    // formSteps.eq(currentStep).show();
                    formSteps.eq(currentStep).css('display', 'grid');
                    currentStep++;
                } else {
                    // Display error messages for the current step
                    form.validate().focusInvalid();
                }

                const currentStepName = `step${currentStep}`;
                selectStep(stepBlock[currentStepName]);
            }

            function prevStep() {

                if (currentStep > 1) {
                    formSteps.eq(currentStep - 1).hide();
                    formSteps.eq(currentStep - 2).show();
                    currentStep--;
                }
                const currentStepName = `step${currentStep}`;
                selectStep(stepBlock[currentStepName]);
            }

            formSteps.each(function(index) {
                $(this).find("button.next").on("click", function(e) {
                    e.preventDefault();
                    nextStep();
                    window.scrollTo(0, 238);
                });

                if (index > 0) {
                    $(this).find("button.back").on("click", function(e) {
                        e.preventDefault();
                        prevStep();
                        window.scrollTo(0, 238);
                    });
                }
            });

            $("#finish-btn").on('click', function(event) {
                event.preventDefault();
                nextStep();
            });

            // Apply validation rules and messages for each step
            // formSteps.each(function(index) {
            //     var fieldsetID = $(this).attr("id");
            //     var validationGroup = validationRules["step1"];
            //     // var validationMessagesGroup = validationMessages[fieldsetID];

            //     form.validate({
            //         rules: validationGroup,
            //         // messages: validationMessagesGroup
            //     });
            // });
        });
    </script>
@endpush
