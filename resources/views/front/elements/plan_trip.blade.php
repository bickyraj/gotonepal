<div class="py-20">
    <div class="container">
        <div class="flex justify-center">
                <div>
                    <p class="mb-2 text-2xl text-center text-primary font-handwriting">Discover authentic ways to explore the world.</p>
                    <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 font-display">
                        Plan your trip with our International Representatives
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>
        <div class="grid grid-cols-2 gap-6 lg:grid-cols-5">
            @if ($teams && iterator_count($teams))
                @foreach ($teams as $team)
                    <div class="col-span-2 mb-4 lg:col-span-1">
                        <img src="{{ $team->imageUrl }}" alt="" class="aspect-[3/4] object-cover mb-4 w-full">
                        <div class="text-center">
                            <h3 class="text-lg font-bold">{{ $team->name }}</h3>
                            <h2>{{ $team->position }}</h2>
                            <a href="tel:{{ $team->phone }}">{{ $team->phone }}</a></br>
                            <a href="mailto:{{ $team->email }}" style="font-size: 15px;">{{ $team->email }}</a>
                        </div>
                    </div>
                @endforeach
            @endif
            {{--
            <div class="col-span-2 px-4 prose">
                <h2>
                    <div class="text-2xl font-bold text-left text-primary font-handwriting">
                        Discover authentic ways to explore the world.
                    </div>
                    <div class="mb-4 text-2xl text-left text-gray-600 font-display">
                        Plan your trip with our International Representatives
                    </div>
                </h2>
                <p>Feel free to inquire, and together, we'll design the perfect journey to suit your preferences and desires.</p>
                @if (request()->routeIs('home'))
                    <a href="https://www.gotonepal.com/plan-my-trip" class="btn btn-accent" style="text-decoration:none;">Plan Your Trip</a>
                @else
                    <a href="{{ route('front.contact.index') }}" class="btn btn-accent" style="text-decoration:none;">Contact Us</a>
                @endif
            </div>
            --}}
        </div>
        <div class="text-center">
                <a href="https://www.gotonepal.com/plan-my-trip" class="btn btn-primary">Plan Your Trip</a>
        </div>
    </div>
</div>
