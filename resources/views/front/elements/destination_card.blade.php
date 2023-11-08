<a href="{{ route('front.destinations.show', $destination->slug)}}" class="relative destination @if ($loop->first) lg:col-span-2 @endif">
    <div class="h-full overflow-hidden rounded destination__img">
        <img src="{{ $destination->imageUrl }}"
            class="block object-cover w-full h-full" alt="{{ $destination->image_alt ?? $destination->name }}">
    </div>
    <div class="absolute px-4 py-2 bg-white rounded shadow-sm bottom-2 left-2">
        <h3 class="font-display">{{ $destination->name }}</h3>
        <div class="text-sm text-gray">{{ $destination->trips->count() }} tours</div>
    </div>
</a>
