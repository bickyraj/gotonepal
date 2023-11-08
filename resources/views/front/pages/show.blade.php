@extends('layouts.front')
@section('content')
    {{-- Hero --}}
    @include('front.elements.hero', [
        'title' => $page->name,
        'image' => $page->imageUrl,
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ])

    <section class="py-20">
        <div class="container">
            <div class="grid gap-1 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="prose">
                        <?= $page->description ?? '' ?>
                    </div>
                </div>
                <aside>
                    <!-- enquiry block -->
                    {{-- @include('front.elements.enquiry') --}}
                    <!-- end of enquiry block -->
                </aside>
            </div>
        </div>

    </section>



    <!--<section class="hero-second">-->
    <!--  <div class="slide" style="background-image: url({{ $page->imageUrl ?? '' }})">-->
    <!--  </div>-->
    <!--  <div class="hero-bottom">-->
    <!--    <div class="container">-->
    <!--      <h1>{{ $page->name ?? '' }}</h1>-->
    <!--      <nav aria-label="breadcrumb">-->
    <!--        <ol class="breadcrumb">-->
    <!--          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>-->
    <!--          <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>-->
    <!--        </ol>-->
    <!--      </nav>-->
    <!--    </div>-->
    <!--</section>-->

    <!--<section class="tour-details">-->
    <!--  <div class="container mt-2">-->
    <!--    <div class="row">-->
    <!--      <div class="col-md-8 col-lg-9">-->
    <!--        <div class="tour-details-section">-->
    <!--        	<div>-->
    <!--        		<?= $page->description ?? '' ?>-->
    <!--        	</div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="col-md-4 col-lg-3">-->
    <!--        <aside>-->
    <!-- enquiry block -->
    <!--          @include('front.elements.enquiry')-->
    <!-- end of enquiry block -->
    <!--        </aside>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--</section>-->
@endsection
