@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
@endpush

<section>
    <div class="relative hero">
        <!-- Slider -->
        <div id="banner-slider" class="hero-slider">
            @forelse ($banners as $banner)
                <div class="relative slide banner">
                    <img src="{{ $banner->thumbImageUrl }}" data-img="{{ $banner->imageUrl }}" class="block w-full h-96 lg:h-[80vh] object-cover lazyload" alt="{{ $banner->name }}" width="1500"
                        height="1000">
                    <div class="absolute w-full py-4 text lg:py-6">
                        <div class="container">
                            <div class="flex flex-col mb-8">
                                <div class="font-bold text-white hero-slider-title">
                                    <span>{{ $banner->caption }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- Slider -->

        @include('front.elements.trip-search')

        {{-- <div class="absolute hero-slider-controls none md:block">
            <div class="container flex flex-col gap-10">
                <button>
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                    </svg>
                </button>
                <button>
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </button>
            </div>
        </div> --}}

        {{-- <div class="absolute w-full banner-search-container">
            <div class="container">
                <form action="{{ route('front.trips.search') }}" id="banner-search-from">
                    <div class="flex max-w-xl overflow-hidden rounded-lg">
                        <input id="banner-search" class="flex-grow px-10 py-4 text-gray-700 placeholder-gray-500 bg-white border-0 focus:placeholder-transparent lg:text-lg" type="text"
                            name="keyword" placeholder="Find your adventures..." aria-label="Search site" style="min-width:0;">
                        <button class="px-6 py-3 font-medium tracking-wider text-gray-100 rounded-md lg:text-xl bg-primary hover:bg-primary-dark focus:bg-primary-dark focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}
    </div><!-- Hero -->
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>

    <script>
        const heroSlider = tns({
            mode: 'gallery',
            container: '.hero-slider',
            nav: false,
            // controlsContainer: '.hero-slider-controls .container',
            controls: false,
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true
        })
    </script>
@endpush
