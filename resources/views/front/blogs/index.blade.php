@extends('layouts.front')
@section('content')

@include('front.elements.hero', [
    'title' => 'Blogs',
    'image' => asset('assets/front/img/hero.jpg'),
    'breadcrumbs' => [
        'Home' => route('home'),
    ],
])

<section class="py-20 news">
    <div class="container">

        <div class="grid gap-10 mb-10 lg:grid-cols-3">
            @forelse ($blogs as $blog)
                @include('front.elements.blog-card')
            @empty
            @endforelse
        </div>
        {{ $blogs->links('pagination.default') }}
    </div>
</section>
@endsection
