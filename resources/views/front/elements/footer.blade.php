<!-- Newsletter -->

<div class="pt-10 bg-gray">
    <div class="relative z-10 max-w-4xl px-4 pb-10 mx-auto">
        <div class="grid gap-8">
            <div class="text-center">
                <h2 class="mb-2 text-3xl font-display text-primary">Subscribe to our Newsletter</h2>
                <div>Sign up to stay updated with latest offers, recent events and more news.</div>
            </div>
            <div>
                <form class="flex flex-col justify-center gap-4 md:flex-row" id="email-subscribe-form">
                    <label for="namsube" class="sr-only">Name</label>
                    <input type="text" id="namesub" class="w-full p-4 border-gray-300 rounded-lg" placeholder="Your full name" required>
                    <label for="emailsub" class="sr-only">Email</label>
                    <input type="email" id="emailsub" class="w-full p-4 border-gray-300 rounded-lg" placeholder="Your email" required>
                    <button type="submit" class="block btn btn-accent">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/front/img/webpage_art.webp') }}" width="1920" height="384" alt="Art representing various natural and cultutal heritages of Nepal" class="w-full h-auto min-h-[15rem] object-cover -mt-40"
        loading="lazy">
</div><!-- Newsletter -->

<!-- Footer -->
<footer>
    {{--
    <div class="container" style="margin-bottom: 15px;">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <a href="{{ route('front.makeapayment') }}" class="btn btn-accent">Make a Payment</a>
        </div>
    </div>
    --}}
    <div class="py-20 text-white bg-primary">
        <div class="container grid grid-cols-2 gap-10 lg:gap-20 lg:grid-cols-5">
            {{-- <div class="mb-4">
                <h1 class="text-2xl text-white font-display">Trekking Destination</h1>
                <ul>
                    @if ($footer1)
                    @foreach ($footer1 as $menu)
                      <li class="text-sm">
                        <a href="{!! ($menu->link)?$menu->link:'javascript:;' !!}">{{ $menu->name }}</a>
                      </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            --}}
            <div class="col-span-2 mb-4 lg:col-span-1">
                <h1 class="text-xl text-white font-display">Quick Links</h1>
                <ul>
                    @if ($footer1)
                        @foreach ($footer1 as $menu)
                            <li class="text-sm">
                                <a href="{!! $menu->link ? $menu->link : 'javascript:;' !!}">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-span-2 mb-4 lg:col-span-1">
                <h1 class="text-xl text-white font-display">Top Activities</h1>
                <ul>
                    @if ($footer2)
                        @foreach ($footer2 as $menu)
                            <li class="text-sm">
                                <a href="{!! $menu->link ? $menu->link : 'javascript:;' !!}">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-span-2 mb-4 lg:col-span-1">
                <h1 class="text-xl text-white font-display">Brochure</h1>
                <img src="{{ asset('assets/front/img/nete-brochure-2020.jpg')}}" alt="" class="block w-40 mb-4">
                <a href="#" class="inline-flex gap-2 px-3 py-2 rounded-lg bg-primary-dark">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                    </svg>
                    Download
                </a>
            </div>
            <div class="col-span-2">

                <h2 class="mb-6 text-xl text-white font-display">Contact us</h2>
                <h3 class="mb-2 text-lg text-white font-display">Nepal Environmental Treks & Expedition</h3>
                <ul class="icon-list">
                    <li class="flex gap-2">
                        <svg class="flex-shrink-0">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" />
                        </svg>
                        <span class="text-sm">{{ Setting::get('address') }}</span>
                    </li>
                    <li class="flex gap-2">
                        <svg class="flex-shrink-0">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                        </svg>
                        <a class="text-sm" href="tel:{{ Setting::get('mobile1') }}">{{ Setting::get('mobile1') }} {{ Setting::get('telephone') }}</a>
                    </li>
                    <li class="flex gap-2">
                        <svg class="flex-shrink-0">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                        </svg>
                        <div>
                            <a class="block mb-1 text-sm" href="mailto:envtrek@gmail.com">
                                envtrek@gmail.com
                            </a>
                            <a class="block mb-1 text-sm" href="mailto:envtreks@gmail.com">
                                envtreks@gmail.com
                            </a>
                            <a class="block text-sm" href="mailto:{{ Setting::get('email') }}">
                                {{ Setting::get('email') }}
                            </a>
                        </div>
                    </li>
                </ul>

                <ul class="flex flex-wrap gap-2 mt-4">
                    <li>
                        <a href="{{ Setting::get('facebook') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-dark hover:bg-[#1877f2]">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('twitter') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-dark hover:bg-[#1da1f2]">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('instagram') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-dark hover:bg-[#ff0069]">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('whatsapp') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-dark hover:bg-[#075e54]">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('viber') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-dark hover:bg-[#8f5db7]">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-6 bg-light">
        <div class="container flex flex-wrap justify-between gap-10 py-6 lg:gap-20">
            <div class="text-center">
                <div class="mb-6 text-sm ">We accept</div>
                <div class="flex gap-1 mb-2">
                    <img src="{{ asset('assets/front/img/amex.svg') }}" alt="American Expressx" loading="lazy" class="h-6">
                    <img src="{{ asset('assets/front/img/mastercard.svg') }}" alt="Mastercard" loading="lazy" class="h-6">
                    <img src="{{ asset('assets/front/img/visa.svg') }}" alt="Visa" loading="lazy" class="h-6">
                    <img src="{{ asset('assets/front/img/jcb.svg') }}" alt="Paypal" loading="lazy" class="h-6">
                    <img src="{{ asset('assets/front/img/maestro.svg') }}" alt="Paypal" loading="lazy" class="h-6">
                </div>
                <a href="#" class="text-sm">Make a payment</a>
            </div>
            <div class="text-center">
                <div class="mb-6 text-sm ">We are a member of</div>
                <ul class="flex flex-wrap items-center justify-center gap-4">
                    <li><a href="#"><img loading="lazy" src="{{ asset('assets/front/img/ng.svg') }}" alt="Nepal Government Ministry of Culture, Tourism & Civil Aviation" width="179"
                                height="150" class="w-auto h-12"></a></li>
                    <li><a href="#"><img loading="lazy" src="{{ asset('assets/front/img/ntb.svg') }}" alt="Nepal Tourism Board" width="148" height="150"
                                class="w-auto h-12"></a>
                    </li>
                    <li><a href="https://www.taan.org.np/"><img loading="lazy" src="{{ asset('assets/front/img/taan.svg') }}" alt="Trekking Agencies' Association of Nepal" width="112"
                                height="150" class="w-auto h-12"></a></li>
                    <li><a href="#"><img loading="lazy" src="{{ asset('assets/front/img/nma.svg') }}" alt="Nepal Mountaineering Association" width="180" height="150"
                                class="w-auto h-12"></a>
                    </li>
                    <li><a href="#"><img src="{{ asset('assets/front/img/keep.webp') }}" alt="" class="w-auto h-12"></a></li>
                    <li><a href="#"><img src="{{ asset('assets/front/img/natta.png') }}" alt="" class="w-auto h-12"></a></li>
                    <li><a href="#"><img src="{{ asset('assets/front/img/himalayan-rescue.png') }}" alt="" class="w-auto h-12"></a></li>
                    <li><a href="#"><img src="{{ asset('assets/front/img/thamel-tourism.webp') }}" alt="" class="w-auto h-12"></a></li>
                </ul>
            </div>
            <div class="text-center">
                <div class="mb-6 text-sm">We are associated with</div>
                <ul class="flex flex-wrap items-center justify-center gap-4">
                    <li><a href="#"><img loading="lazy" src="{{ asset('assets/front/img/tripadvisor.svg') }}" alt="Tripadvisor" width="179"
                                height="150" class="w-auto h-14"></a></li>
                    <li><a href="#"><img loading="lazy" src="{{ asset('assets/front/img/tourradar.svg') }}" alt="Tourradar" width="148" height="150"
                                class="w-auto h-10"></a>
                    </li>
                    <li><a href="#"><img loading="lazy" src="{{ asset('assets/front/img/viator.svg') }}" alt="Viator" width="148" height="150"
                                class="w-auto h-4"></a>
                    </li>
                </ul>
                <a href="#" class="text-sm">View all</a>
            </div>
        </div>
        <div class="container py-6 text-sm border-t border-gray-300">
            &copy; Copyright 2008 - {{ date('Y') }}. All right Reserved to Nepal Environmental Treks and Expedition.
        </div>
    </div>
</footer><!-- Footer -->
@push('scripts')
    <script type="text/javascript">
        $(function() {

            $('#email-subscribe-form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: "{{ route('front.email-subscribers.store') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    async: "false",
                    success: function(res) {
                        if (res.status == 1) {
                            toastr.success(res.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var status = jqXHR.status;
                        if (status == 404) {
                            toastr.warning("Element not found.");
                        } else if (status == 422) {
                            toastr.info(jqXHR.responseJSON.errors.email[0]);
                        }
                    }
                });

            });
        });
    </script>
@endpush
