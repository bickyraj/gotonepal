<a href="{{ route('front.blogs.show', $blog->slug) }}">
    <div class="article">
        <img src="{{ $blog->imageUrl }}" alt="{{ $blog->image_alt }}" loading="lazy" class="rounded-t-lg object-cover aspect-[3/2]">
        <div class="flex items-center mt-6 mb-2 text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ formatDate($blog->blog_date) }}
        </div>
        <h3 class="mb-4 text-xl font-display">{{ $blog->name }}</h3>
        <div class="prose">
            <p>
                {{ truncate(
                    trim(strip_tags($blog->description)) !== ''
                    ? trim(strip_tags($blog->description))
                    : trim(strip_tags($blog->toc))
                )}}
            </p>
        </div>
    </div>
</a>