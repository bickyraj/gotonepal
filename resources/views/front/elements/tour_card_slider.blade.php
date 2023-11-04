<div class="relative">
    <div class="grid gap-10 lg:grid-cols-2 lg:gap-20">
        <div>
            <img src="{{ $tour->imageUrl }}" alt="{{ $tour->name }}" style="border-radius: 10px;" loading="lazy">
        </div>
        <div>
            <h3 class="mb-4 text-3xl font-display">
                {{ $tour->name }}
            </h3>
            <div class="mb-10 prose text-gray-200">
                <p> {!! truncate(trim(strip_tags($tour->trip_info['overview'] ?? '')), 300) !!} </p>
            </div>

            <div class="flex flex-wrap gap-4 mb-10">
                <div class="flex items-center gap-4 px-4 py-2 rounded-lg bg-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}"></use>
                    </svg>
                    <div>
                        <div class="text-sm font-bold">Duration</div>
                        <span class="font-bold"> <?= $tour->duration ?> </span> days
                    </div>
                </div>
                <div class="flex items-center gap-4 px-4 py-2 rounded-lg bg-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#emojihappy') }}"></use>
                    </svg>
                    <div>
                        <div class="text-sm font-bold">Difficulty</div>
                        {{ $tour->difficulty_grade_value }}
                    </div>
                </div>
                @if ($tour->cost)
                    <div class="px-4 py-2 rounded-lg bg-primary">
                        <div class="text-gray-200">
                            <span class="text-sm">
                                from
                            </span>
                            <s class="font-bold">
                                USD {{ number_format($tour->cost, 2) }}
                            </s>
                        </div>
                        <div class="font-display">
                            <span>USD</span>
                            @php
                                $price_arr = explode('.', number_format($tour->offer_price, 2));
                            @endphp
                            <span class="text-2xl">{{ $price_arr[0] }}</span>
                            <span>.{{ $price_arr[1] }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('front.trips.show', $tour->slug) }}" class="btn btn-accent">
                    Explore
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}"></use>
                    </svg>
                </a>
                {{-- <a href="tour-details.php" class="btn btn-gray">
                            Book Now
                        </a> --}}
            </div>
        </div>
    </div>
</div>
