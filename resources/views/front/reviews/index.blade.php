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
@push('styles')
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
@endpush
@section('content')
    {{-- Hero --}}
    @include('front.elements.hero', [
        'title' => 'Reviews',
        'image' => asset('assets/front/img/hero.jpg'),
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ])

    <section class="py-20">
        <div class="container">
            <div class="grid gap-10 lg:gap-20 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="grid gap-20 mb-10">
                        @forelse ($reviews as $review)
                            @include('front.elements.review-card')
                        @empty
                        @endforelse
                    </div>
                    {{ $reviews->links('pagination.default')}}
                </div>
                <aside>
                    <a href="{{ route('front.reviews.create') }}" class="mb-4 btn btn-accent">Write a review</a>
                    @include('front.elements.enquiry')
                </aside>
            </div>
        </div>

    </section>
@endsection
@push('scripts')
    <script>
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            var enquiry_validator = $("#enquiry-form").validate({
                ignore: "",
                rules: {
                    'name': 'required',
                    'email': 'required',
                    'country': 'required',
                    'phone': 'required',
                    'message': 'required',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.flex'));
                    // error.append(element.closest('.form-group'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    if (grecaptcha.getResponse(0)) {
                        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        grecaptcha.reset(enquiry_captcha);
                        grecaptcha.execute(enquiry_captcha);
                    }
                },
            });
        });

        function onSubmitEnquiry(token) {
            $("#enquiry-form").submit();
            return true;
        }

        let enquiry_captcha;
        var CaptchaCallback = function() {
            enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {
                'sitekey': '{!! config('constants.recaptcha.sitekey') !!}'
            });
            // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '{!! config('constants.recaptcha.sitekey') !!}'});
        };
    </script>
@endpush
