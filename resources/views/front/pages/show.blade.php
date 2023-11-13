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
            <div class="grid gap-10 lg:gap-20 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="prose prose-h2:text-primary">
                        @if ($contents)
                            {!! $body !!}
                        @else
                            {!! $page->description !!}
                        @endif
                    </div>
                </div>
                <aside>
                    @if ($contents)
                        <div class="p-10 mb-10 bg-gray-100">
                            <div class="-ml-4 prose prose-a:no-underline prose-li:list-none">{!! $contents !!}  </div>
                        </div>
                    @endif

                    <div class="p-10 mb-10 bg-gray-100">
                        <ul>
                            @if ($menu)
                                @foreach ($menu as $item)
                                    <li class="mb-2">
                                        <a href="{{ $item->link ? $item->link : '' }}" class="flex gap-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mt-1 text-gray-400" viewBox="0 0 16 16">
                                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                            </svg>
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    @include('front.elements.enquiry')
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
