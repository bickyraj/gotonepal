@extends('layouts.front')
@section('content')
    <!-- Hero -->
    <section class="relative hero hero-alt">
        {{-- <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" style="border-radius: 0px;height: 300px;"> --}}
        {{-- <img src="{{ $page->imageUrl }}" alt="" style="border-radius: 0px;height: 400px;"> --}}
        <img src="{{ $page->imageUrl }}" alt="">
        <div class="absolute overlay">
            <div class="container ">
                <h1>{{ $page->name ?? '' }}</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->name ?? '' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-20 about-page">
        <div class="container">
           


            <div class="py-10 text-center">
               
            </div>
            <!--<div class="tour-details-section prose">-->
            <!--    <p>-->
            <!--        <?= $page->description ?? '' ?>-->
            <!--    </p>-->
            <!--</div>-->
        </div>
        </div>

    </section>
@endsection
