<div class="p-2">
    <div class="items-start md:flex">
        <div class="flex-shrink-0 mb-4 md:mr-4">
            <img src="{{ $item->imageUrl }}" width="250" alt="" style="border: 13px solid #e8e8e8; border-radius: 140px;">
        </div>
        <div>
            <h2 class="mb-1 text-2xl font-display text-primary">{{ $item->name }}</h2>
            <div class="mb-2 text-gray">{{ $item->position }}</div>
            <div class="mb-6 prose">{!! truncate(strip_tags($item->description), 300) !!}</div>
            <a href="{{ route('front.teams.show', ['slug' => $item->slug]) }}" class="btn btn-sm btn-primary">Read more</a>
        </div>
    </div>
</div>
