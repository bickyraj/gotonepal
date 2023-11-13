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

<section class="py-20">
    <div class="container">
        <div class="grid gap-10 lg:gap-20 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <h1 class="mb-4 text-4xl font-bold text-gray-600 drop-shadow-xl">
                    Book {{$trip->name}} Departure
                </h1>
                <nav aria-label="breadcrumb" class="mb-10">
                    <ol>
                        <li class="inline"><a href="{{ route('home') }}">Home</a> / </li>
                        <li class="inline"><a href="{{ route('front.trips.listing') }}">Trips</a> / </li>
                        <li class="inline"><a href="{{ route('front.trips.show', $trip->slug) }}">{{ $trip->name }}</a> / </li>
                        <li class="inline"><a href="" aria-current="page">Book Departure</a></li>
                    </ol>
                </nav>
                <div class="mb-10">
                    <p>Begins: <span class="inline-block mr-10 text-xl">{{ formatDate($trip_departure->from_date) }}</span> Ends:  <span class="mr-10 text-xl">{{ formatDate($trip_departure->to_date) }}</span></p>
                </div>

                <form id="captcha-form" action="{{ route('front.trips.departure-booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="departure_id" value="{{ $trip_departure->id }}">
                    <input type="hidden" name="id" value="{{ $trip->id }}">
                    <h2 class="mb-2 text-xl font-bold font-display text-primary">Personal details</h2>
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
                    </div>
                    <div class="grid gap-4 mb-10 lg:grid-cols-2">
                        <div class="form-group">
                            <label for="">Country *</label>
                            @include('front.elements.country')
                        </div>
                        <div></div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Contact no. *</label>
                            <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                        </div>
                        <div class="form-group">
                            <label for="">Gender *</label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="" selected disabled>Gender</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Date of birth *</label>
                            <input type="date" name="dob" id="" class="form-control" max="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>

                    <h2 class="mb-2 text-xl font-bold font-display text-primary">Trip details</h2>
                    <div class="grid gap-4 mb-2 lg:grid-cols-2">
                        <div class="form-group">
                            <label for="">Passport no.</label>
                            <input type="text" name="passport_no" class="form-control" placeholder="Passport No.">
                        </div>
                        <div class="form-group">
                            <label for="">Place of issue</label>
                            <input type="text" name="place_of_issue" class="form-control" placeholder="Place of issue">
                        </div>
                        <div class="form-group">
                            <label for="">No. of travellers</label>
                            <input type="number" name="no_of_travellers" class="form-control" min="<?php echo date('Y-m-d');?>"
                            placeholder="No. of travellers">
                        </div>
                        <div class="form-group">
                            <label for="">Emergency Contact *</label>
                            <textarea name="emergency_contact" id="" cols="30" rows="3" class="form-control"
                            placeholder="Emergency Contact"></textarea>
                        </div>
                    </div>
                    @include('front.elements.recaptcha')
                    <input type="hidden" id="recaptcha" name="google_recaptcha" value="">
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>

            <aside>
                <img src="{{ $trip->mediumImageUrl }}" alt="" class="rounded-t-lg">
                <div class="p-10 bg-gray-100 rounded-b-lg">
                    <h2 class="mb-4 text-2xl font-display text-primary ">{{ $trip->name }}</h2>
                    <div class="flex justify-between mb-2"><span>Duration:</span><span> {{ $trip->duration }} Days</span></div>
                    @if($trip->offer_price)
                        <b class="text-gray-600">US$ {{ $trip_departure->price }}</b> per person
                    @endif
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
      toastr.error(session_error_message);
    }
  });
</script>
@endpush