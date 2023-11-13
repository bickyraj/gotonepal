<div class="py-20">
    <div class="container">
        <!--<div class="container">-->
        <div class="grid grid-cols-2 gap-6 lg:grid-cols-6">
            @if ($teams && iterator_count($teams))
                @foreach ($teams as $team)
                    <div>
                        <img src="{{ $team->imageUrl }}" alt="" class="aspect-[3/4] object-cover mb-4 w-full">
                        <div class="text-center">
                            <h2>{{ $team->position }}</h2>
                            <h3 class="text-lg font-bold">{{ $team->name }}</h3>
                            <a href="tel:{{ $team->phone }}">{{ $team->phone }}</a>
                        </div>
                    </div>
                @endforeach
            @endif
            {{-- <div>
                <img src="{{ asset('assets/front/img/navraj.jpeg')}}" alt="" class="aspect-[3/4] object-cover mb-4 w-full">
                <div class="text-center">
                    <h2>Our Managing Director</h2>
                    <h3 class="text-lg font-bold">Navaraj Dahal</h3>
                    <a href="tel:+977-9851031532">+977 9851031532</a>
                </div>
            </div>
            <div>
                <img src="{{ asset('assets/front/img/plan-mahesh.jpg')}}" alt="" class="aspect-[3/4] object-cover mb-4 w-full">
                <div class="text-center">
                    <h2>Our Correspondace Officer</h2>
                    <h3 class="text-lg font-bold">Mahesh Chaulagain</h3>
                    <a href="tel:+977-9851031532">+977 9851031532</a>
                </div>
            </div>
            <div>
                <img src="{{ asset('assets/front/img/plan-ramesh.jpg')}}" alt="" class="aspect-[3/4] object-cover mb-4 w-full">
                <div class="text-center">
                    <h2>Our Belgium representative</h2>
                    <h3 class="text-lg font-bold">Ramesh Dahal</h3>
                    <a href="tel:+977-9851031532">+977 9851031532</a>
                </div>
            </div>
            <div>
                <img src="{{ asset('assets/front/img/biswas.jpg')}}" alt="" class="aspect-[3/4] object-cover mb-4 w-full">
                <div class="text-center">
                    <h2>Our UK representative</h2>
                    <h3 class="text-lg font-bold">Bishwash Dahal</h3>
                    <a href="tel:+977-9851031532">+977 9851031532</a>
                </div>
            </div> --}}
            <div class="col-span-2 px-4 prose">
                <h2>
                    <div class="text-2xl font-bold text-left text-primary font-handwriting">
                        Discover authentic ways to explore the world.
                    </div>
                    <div class="mb-4 text-3xl text-left text-gray-600 font-display">
                        Plan your trip with local expert
                    </div>
                </h2>
                <p>Feel free to inquire, and together, we'll design the perfect journey to suit your preferences and desires.</p>
                @if (request()->routeIs('home'))
                    <a href="#" class="btn btn-accent" style="text-decoration:none;">Plan Your Trip</a>
                @else
                    <a href="{{ route('front.contact.index') }}" class="btn btn-accent" style="text-decoration:none;">Contact Us</a>
                @endif
            </div>
        </div>
    </div>
</div>
