@extends('layouts.front_inner')
@section ('content')
    {{-- Hero --}}
    @include('front.elements.hero', [
        'title' => 'Frequently Asked Questions',
        'image' => asset('assets/front/img/hero.jpg'),
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ])

    <section class="py-20">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-3 xl:grid-cols-4">
                <div class="lg:col-span-2 xl:col-span-3">
                    @foreach($faq_categories as $category)
                        @if(iterator_count($category->faqs))
                            <div class="mb-8" x-data="{active: 'none'}">
                                <h2 class="mb-2 text-2xl font-display text-primary">{{ $category->name }}</h2>
                                @foreach($category->faqs as $key => $faq)
                                    <div class="mb-1 border-light">
                                        <button class="flex items-center justify-between w-full p-2 text-left" @click="active = (active === {{ $key }} ? 'none' : {{ $key }})">
                                            <h3 class="text-xl text-gray-600 font-display">{{ $faq->title }}</h3>

                                            <svg class="flex-shrink-0 w-6 h-6 text-primary" x-show="active!=={{ $key }}">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#plus" />
                                            </svg>
                                            <svg class="flex-shrink-0 w-6 h-6 text-primary" x-show="active==={{ $key }}">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#minus" />
                                            </svg>
                                        </button>
                                        <div class="p-4" x-cloak x-show.transition="active==={{ $key }}">
                                            <div class="prose">{!! $faq->content !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                {{-- <aside>
                    @include('partials.enquiry')
                </aside> --}}
            </div>
        </div>

    </section>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
@endpush