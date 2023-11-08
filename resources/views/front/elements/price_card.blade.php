<div class="pt-4 mb-6 price-card bg-primary">
    <div class="relative flex mb-4 ribbon">
        <div class="relative px-4 py-1 text-2xl bg-white font-display text-accent">
            Best Price
        </div>
    </div>

    <div class="p-4 text-white">
        @if ($trip->cost)
            <div class="">
                <span class="mb-2 mr-2 text-sm">Price starting from</span>
                <s class="text-xl font-bold">${{ number_format($trip->cost) }}</s>
            </div>
            <div class="mb-2 font-display">
                <span class="text-2xl font-bold">US $</span>
                <span class="text-5xl font-bold text-light">{{ number_format($trip->offer_price) }}</span>
                <span class="text-xl">per person</span>
            </div>
        @endif
        <div class="mb-2 text-center">
            <a href="{{ route('front.trips.booking', $trip->slug) }}" class="w-full mb-2 font-bold btn btn-accent">Book Now</a>
            <a href="{{ route('front.plantrip.createfortrip', $trip->slug) }}" class="btn btn-accent">

                <svg class="flex-shrink-0 w-6 h-6 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#adjustments" />
                </svg>
                Plan My Trip
            </a>
        </div>
        <div class="p-1 actions">
            <a href="{{ route('front.trips.print', ['slug' => $trip->slug]) }}" class="flex items-center p-1 text-light" title="Print tour details">
                <svg class="flex-shrink-0 w-4 h-4 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#printer" />
                </svg>
                <span class="text-sm">Print Tour Details</span>
            </a>
            @if ($trip->pdf_file_name)
                <a href="#" class="flex items-center p-1 text-light" title="">
                    <svg class="flex-shrink-0 w-4 h-4 mr-2">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#download" />
                    </svg>
                    <span class="text-sm">Download Tour Brochure</span>
                </a>
            @endif
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.trips.show', ['slug' => $trip->slug]) }}" class="flex items-center p-1 text-light" title="Share tour">
                <svg class="flex-shrink-0 w-4 h-4 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#share" />
                </svg>
                <span class="text-sm">Share Tour</span>
            </a>
        </div>
    </div>
    {{-- <div class="p-2 bg-light">
        <div class="mb-2 font-bold">Get group discounts</div>
        <table>
            <thead>
                <th class="px-1 py-2 font-display">Group size</th>
                <th class="px-1 py-2 font-display">Price per person</th>
            </thead>
            <tbody>
                <tr>
                    <td class="px-1 py-2 text-sm">1 person</td>
                    <td class="px-1 py-2 text-sm text-right">$1500</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">2 - 4 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1450</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">5-10 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1425</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">10-20 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1415</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">more than 20 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1415</td>
                </tr>
            </tbody>
        </table>
    </div> --}}
</div>
