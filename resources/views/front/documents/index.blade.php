@extends('layouts.front')
@section('content')
    {{-- Hero --}}
    @include('front.elements.hero', [
        'title' => 'Company Legal Documents',
        'image' => asset('assets/front/img/hero.jpg'),
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ])

    <section>
        <div class="container py-20">
            <div class="grid grid-cols-2 gap-10 md:grid-cols-3 lg:grid-cols-4">
                @forelse($documents as $document)
                    <a href="{{ $document->fileUrl }}" class="stretched-link" data-fancybox="gallery" data-caption="{{ $document->name }}">
                        <img src="{{ $document->fileUrl }}" alt="" class="object-contain object-center w-full h-full border border-gray-200">
                    </a>
                @empty
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <p>No Documents to show.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(function() {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: ['close']
            });
        });
    </script>
@endpush
