<?php
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>
@extends('layouts.front_inner')
@section('content')
    <section class="py-20" x-data="{ noOfTravellers: 1, rate: {{ isset($trip->offer_price) && !empty($trip->offer_price) ? $trip->offer_price : $trip->cost }}, paymentType: 'half', agree: false }">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <h1 class="mb-4 text-4xl font-bold text-gray-600 drop-shadow-xl">
                        Book {{$trip->name}}
                    </h1>
                    <nav aria-label="breadcrumb" class="mb-10">
                        <ol>
                            <li class="inline"><a href="{{ route('home') }}">Home</a> / </li>
                            <li class="inline"><a href="{{ route('front.trips.listing') }}">Trips</a> / </li>
                            <li class="inline"><a href="{{ route('front.trips.show', $trip->slug) }}">{{ $trip->name }}</a> / </li>
                            <li class="inline"><a href="" aria-current="page">Book</a></li>
                        </ol>
                    </nav>
                    {{-- <form id="captcha-form" action="{{ route('front.trips.booking.store') }}" method="POST"> --}}
                    <form id="captcha-form" action="{{ route('front.store_payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $trip->id }}">
                        <h2 class="mb-2 text-xl font-bold text-primary">Personal details</h2>
                        <div class="grid gap-4 mb-2 lg:grid-cols-3">
                            <div class="form-group">
                                <label for="">First name *</label>
                                <input type="text" class="form-control" name="first_name" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Middle name</label>
                                <input type="text" class="form-control" name="middle_name" placeholder="Middle name">
                            </div>
                            <div class="form-group">
                                <label for="">Last name *</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Country *</label>
                                @include('front.elements.country')
                            </div>
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contact no. *</label>
                                <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-2 lg:grid-cols-3">
                            <div class="form-group">
                                <label for="">Gender </label>
                                <select name="gender" id="" class="form-control">
                                    <option value="" selected disabled>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-2 lg:grid-cols-1">
                            <div>
                                <label for="" class="text-sm">Payment </label>
                                <div class="flex gap-10">
                                    <div class="flex gap-2">
                                        <input type="radio" name="payment_type" id="full" value="full" x-model="paymentType" class="rounded-full">
                                        <label for="full">
                                            Full amount payment
                                        </label>
                                    </div>
                                    <div class="flex gap-2">
                                        <input checked type="radio" name="payment_type" id="twentyfive" value="half" x-model="paymentType" class="rounded-full">
                                        <label for="twentyfive">
                                            25% advance payment
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2 class="mt-10 mb-2 text-xl font-bold text-primary">Trip details</h3>
                            <div class="grid gap-2 mb-2 lg:grid-cols-3">
                                <div class="form-group">
                                    <label for="">No. of travellers </label>
                                    <input type="number" name="no_of_travellers" class="form-control" min="1" x-model="noOfTravellers" placeholder="No. of travellers">
                                </div>
                                <div class="form-group">
                                    <label for="">Preferred departure date</label>
                                    <input type="date" name="preferred_departure_date" name="" id="" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="grid gap-2 mb-4 lg:grid-cols-3">
                                <div class="form-group lg:col-span-2">
                                    <label for="">Message </label>
                                    <textarea name="emergency_contact" id="" cols="60" rows="3" class="form-control" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div>
                                <label class="flex items-baseline gap-2">
                                    <input type="checkbox" name="agree" x-model="agree">
                                    <span>I have read and agree with the <a href="#" class="underline">terms and conditions</a> of the company.</span>
                                </label>
                            </div>
                            @include('front.elements.recaptcha')
                            <div class="mt-4"><button id="make_a_payment_btn" class="px-3 py-2 text-white rounded enabled:bg-accent disabled:bg-gray-400" x-bind:disabled="!agree">Submit</button></div>
                    </form>
                </div>

                <aside>
                    <img src="{{ $trip->imageUrl }}" alt="" class="mb-2">
                    <div class="p-4 rounded-lg bg-light">
                        <h2 class="text-2xl font-bold text-primary">Book {{ $trip->name }}</h2>
                        <div class="mt-4 card-body">
                            <p class="flex justify-between"><span>Duration:</span>{{ $trip->duration }} days</p>
                            <p class="flex justify-between"><span>No of Travellers:</span><span><span x-text="noOfTravellers"></span> people</span></p>
                            <p class="flex justify-between"><span>Rate:</span><span>USD <span x-text="rate.toLocaleString()"></span></span></p>
                            <hr>
                            <p class="flex justify-between"><span>Total amount:</span><span class="font-bold text-primary">USD <span x-text="(noOfTravellers * rate).toLocaleString()"></span></span></p>

                            <p class="flex justify-between"><span>Payable Now:</span><span class="font-bold text-primary">USD <span
                                        x-text="(noOfTravellers * rate * ((paymentType === 'half')? 0.25: 1)).toLocaleString()"></span></span></p>

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            $(document).on('click', '#make_a_payment_btn', function(ev) {
                ev.preventDefault();
                let btn = $(this);
                btn.prop('disabled', true);
                btn.html('submitting...');
                setTimeout(() => {
                    $("#captcha-form").submit();
                }, 1000);
            });
        });
    </script>
@endpush
