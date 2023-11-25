<div class="p-2" x-data="{ expanded: false, showControls: true }" x-init="if ($refs.description.scrollHeight < 427) { expanded = true; showControls = false }">
    <div class="items-start gap-6 md:flex">
        <div class="flex-shrink-0 mb-4 md:mr-4">
            <img src="{{ $item->imageUrl }}" width="250" alt="" style="border: 10px solid #e8e8e8; border-radius: 140px;">
        </div>
        <div>
            <h2 class="mb-1 text-2xl font-display text-primary">{{ $item->name }}</h2>
            <div class="mb-2 text-gray">{{ $item->position }}</div>
            <div class="relative">
                <div class="mb-6 prose" x-show="expanded" :class="{'pb-20': showControls}" x-collapse.min.330px x-ref="description">{!! $item->description !!}</div>
                <div class="absolute bottom-0 flex justify-center w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));" x-show="showControls">
                    <button
                        class="px-4 py-2 text-xs rounded-full bg-light" x-on:click="expanded=!expanded"
                        x-text="expanded?'Show less':'Show more'">Show more</button>
                </div>
            </div>
        </div>
    </div>
</div>
