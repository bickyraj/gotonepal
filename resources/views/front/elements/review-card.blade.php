<div class="bg-white rounded-lg review">
    <div class="mb-4 review__content">
        <h3 class="mb-4 text-xl font-display">{{ $review->title }}</h3>
        <div class="prose">
            <p>{{ $review->review }}</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        @if ($review->thumbImageUrl)
            <img src="{{ $review->thumbImageUrl }}" alt="{{ $review->review_name }}" loading="lazy">
        @else
            <div class="flex items-center justify-center w-16 h-16 text-xl rounded-full bg-light text-primary">
                {{ $review->review_name[0] }}
            </div>
        @endif
        <div>
            <div class="font-bold text-gray-600">{{ ucfirst($review->review_name) }}</div>
            <div class="text-sm text-gray">{{ $review->review_country }}</div>
            <div class="flex">
                @for ($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-accent">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                    </svg>
                @endfor
            </div>
        </div>
    </div>
</div>