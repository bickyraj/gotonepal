@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

{{-- Header --}}
<header class="relative w-full transition bg-white border-b border-gray-200 header" x-data="{ mobilenavOpen: false, searchboxOpen: false }">
    <div class="text-sm bg-light">
        <div class="container flex flex-wrap justify-between h-10 gap-10 text-sm text-gray-600">

            <div class="flex items-center py-1 text-xs font-bold lg:pl-36">True spirit of adventure since 1990</div>

            <div class="relative hidden lg:block w-28">
                <div class="absolute right-0 md:right-[unset] flex items-center px-4 py-1 font-bold text-red-100 bg-red-600 h-14 font-display">
                    <div class="text-center">
                        <div class="text-lg whitespace-nowrap">33 years</div>
                        <div class="whitespace-nowrap">of excellence</div>
                    </div>
                    <div class="absolute bottom-0 left-full">
                        <div class="w-4 h-4 border-8 border-t-red-700 border-l-red-700 border-r-transparent border-b-transparent"></div>
                    </div>
                </div>
            </div>

            <div class="items-center hidden py-1 text-xs md:flex">Regd. No: 50058/064/065</div>

            {{-- Talk to expert --}}
            <div class="items-center hidden gap-2 px-4 py-1 text-white md:flex bg-primary">
                <span class="font-bold">Talk to an expert</span>
                <a href="tel:{{ Setting::get('mobile1') ?? '' }}" class="flex items-center">
                    <div>{{ Setting::get('mobile1') ?? '' }}</div>
                </a>
                <a href="{{ Setting::get('viber') ?? '' }}" style="color:#d766ff">
                    <svg class="w-6 h-6" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 486 513">
                        <path fill="#fff"
                            d="M444.71 286.962c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9.4-85.7.4-85.7-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9.4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1Z" />
                        <path fill="#d766ff" fill-rule="nonzero"
                            d="M430.81 49.862c-12.7-11.7-64.1-49-178.7-49.5 0 0-135.1-8.1-200.9 52.3-36.6 36.6-49.5 90.3-50.9 156.8-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5Zm13.9 237.1c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9.4-85.7.4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9.4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1Zm-139-80.8c.4 8.6-12.5 9.2-12.9.6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4.7-12.9 27.9 1.5 43.4 17.5 44.8 46.2Zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5.9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3Zm47 13.4c.1 8.6-12.9 8.7-12.9.1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7.5 133 51.4 133.7 139.2Zm-11.3 98.1v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1.8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6Z" />
                    </svg>
                </a>
                <a href="{{ Setting::get('whatsapp') ?? '' }}" style="color:#28d146">
                    <svg class="w-6 h-6" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 448 448">
                        <path fill="#fff"
                            d="M223.9 406.7c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 327.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6Z" />
                        <path fill="#28d146" fill-rule="nonzero"
                            d="M380.9 65.1C339 23.1 283.2 0 223.9 0 101.5 0 1.9 99.6 1.9 222c0 39.1 10.2 77.3 29.6 111L0 448l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157Zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 327.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6Zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6Z" />
                    </svg>
                </a>
            </div>
            {{-- Talk to expert --}}
        </div>
    </div>
    <div class="container relative flex justify-between w-full h-24">
        <!-- Logo -->
        <a class="flex items-center flex-shrink-0 h-full gap-2 md:gap-4" href="{{ route('home') }}">
            <div class="flex items-end h-full">
                <img src="{{ asset('assets/front/img/logo.png') }}" class="block h-20 lg:h-32 brand" alt="{{ config('app.name') }}" width="160" height="138">
            </div>
            <div class="py-3">
                <div class="md:text-2xl text-primary font-display">Nepal Environmental<br>Treks & Expedition</div>
            </div>
        </a><!-- Logo -->

        {{-- Right --}}
        <div class="flex items-center gap-2">
            <!-- Nav -->
            @include('front.elements.navbar')

            {{-- Search --}}
            <button class="hidden p-2 rounded-full lg:block bg-light" @click="searchboxOpen=true;$refs.searchInput.focus()">
                <svg class="w-6 h-6 text-primary hover:bg-primary hover:text-white">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#search"></use>
                </svg>
            </button>

            <div x-show="searchboxOpen" x-cloak class="absolute w-full max-w-5xl left-1/2 top-full" @click.away="searchboxOpen=false" style="transform: translateX(-50%)">
                <div class="max-w-5xl px-4 mx-auto" x-data="headerSearch()" x-model="keyword" x-on:click.outside="reset()" x-on:keyup.esc="reset()" x-on:keyup.down="selectNext()"
                    x-on:keyup.up="selectPrev()" x-init="$watch('keyword', () => selectedIndex = '')">
                    <div class="relative max-w-xl mx-auto">
                        <form action="{{ route('front.trips.search') }}" x-on:submit.prevent="handleSubmit($event.target)">
                            <input type="search" name="q" class="w-full px-4 py-4 text-lg text-gray-600 border-2 border-white rounded-lg shadow focus:ring-0 focus:border-accent focus:outline-0"
                                x-ref="searchInput" placeholder="Search Trips">
                            <button
                                class="absolute flex flex-col p-2 -translate-y-1/2 bg-gray-200 rounded-lg text-accent right-2 top-1/2 focus:bg-accent focus:text-white hover:bg-accent hover:text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                </svg>
                            </button>
                        </form>
                        <div class="absolute w-full overflow-scroll rounded-lg max-h-96 top-[calc(100%+1rem)] border border-gray-200 shadow-lg" x-show="filteredTrips.length > 0"
                            x-transition:enter="transition duration-500" x-transition:enter-start="translate-y-4">
                            <ul x-ref="results">
                                <template x-for="(trip, index) in filteredTrips" x-bind:key="trip.url">
                                    <li
                                        :class="{
                                            'transition': true,
                                            'bg-gray-100 hover:bg-gray-50': selectedIndex !== index,
                                            'bg-light': selectedIndex === index,
                                            'border-b border-gray-200': index !== filteredTrips.length
                                        }">
                                        <a x-bind:href="trip.url" class="block px-4 py-2">
                                            <div class="flex gap-4">
                                                <img :src="trip.image_url" alt="" class="object-cover w-16 h-16 rounded-lg">
                                                <div class="flex-grow">
                                                    <div class="text-lg" x-text="trip.name"></div>
                                                    <div class="flex justify-between gap-2">
                                                        <span class="text-sm text-gray-600" x-text="`${trip.duration} days`"></span>
                                                        <span class="text-sm text-gray-600" x-text="`US $ ${trip.offer_price}`"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Search --}}

            {{-- Mobile Nav Button --}}
            <div class="lg:none">
                <button class="p-2" @click="mobilenavOpen=!mobilenavOpen">
                    <svg class="w-6 h-6 header-color" x-show="!mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#menu" />
                    </svg>
                    <svg class="w-6 h-6" x-cloak x-show="mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#x" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>{{-- Header --}}

{{-- <span class="hidden" aria-hidden="true" id="tripsJson">{!! $formattedTrips !!}</span> --}}

@push('scripts')
    <script>
        function headerSearch() {
            return {
                keyword: '',
                selectedIndex: '',
                get filteredTrips() {
                    if (this.keyword === '') {
                        return []
                    }
                    return Alpine.store('search').trips.filter(trip => trip.name.toLowerCase().includes(this.keyword.toLowerCase()))
                },
                reset() {
                    this.keyword = ''
                },
                selectNext() {
                    if (this.selectedIndex === '') {
                        this.selectedIndex = 0;
                    } else {
                        this.selectedIndex++;
                    }
                    if (this.selectedIndex === this.filteredTrips.length) {
                        this.selectedIndex = 0;
                    }
                    this.focusSelected();
                },
                selectPrev() {
                    if (this.selectedIndex === '') {
                        this.selectedIndex = this.filteredTrips.length - 1;
                    } else {
                        this.selectedIndex--;
                    }
                    if (this.selectedIndex === -1) {
                        this.selectedIndex = this.filteredTrips.length - 1;
                    }
                    this.focusSelected();
                },
                focusSelected() {
                    this.$refs.results.children[this.selectedIndex + 1].scrollIntoView({
                        block: 'nearest'
                    })
                },
                handleSubmit(form) {
                    if (this.selectedIndex !== '') {
                        window.location.href = this.filteredTrips[this.selectedIndex].url;
                    } else {
                        form.submit();
                    }
                }
            }
        }

        console.log(headerSearch());
        document.addEventListener('alpine:init', () => {
            Alpine.store('search', {
                init() {
                    this.trips = JSON.parse(document.querySelector('#tripsJson').innerText);
                },
                trips: [],
            })
        });
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/search-trips.js') }}"></script>
@endpush
