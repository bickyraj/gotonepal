<section class="relative">
    <img src="{{ $image }}" alt="" class="w-full h-[24rem] object-cover">
    <div class="absolute bottom-0 w-full text-white bg-gradient-to-t from-black/60 to-primary-dark/0">
        <div class="container">
            <div class="py-10">
                <h1 class="mb-4 text-4xl font-bold lg:text-5xl drop-shadow-xl">
                    {{ $title }}
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="">
                        @foreach ($breadcrumbs as $key => $value)
                            <li class="inline"><a href="{{ $value }}">{{ $key }}</a> / </li>
                        @endforeach
                        <li class="inline"><a href="" aria-current="page">{{ $title }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>