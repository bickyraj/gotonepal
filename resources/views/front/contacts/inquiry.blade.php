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
@extends('layouts.front')
@section('content')

    {{-- Hero --}}
    @include('front.elements.hero', [
        'title' => 'Inquiry',
        'image' => asset('assets/front/img/hero.jpg'),
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ])

    <section class="py-20">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-2 lg:gap-20">
                <div>
                    <div class="mb-8">
                        <form id="captcha-form" action="{{ route('front.inquiry.store') }}" method="POST">
                            @csrf
                            <div class="mb-4 form-group">
                                <label for="name" class="text-sm">Name</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#users" />
                                    </svg>
                                </div> --}}
                                <input type="text" name="name" required class="form-control" id="name" placeholder="Name">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="start-date" class="text-sm">Start Date</label>
                                <input type="date" name="start_date" required class="form-control" id="start-date" placeholder="">
                            </div>
                            <div class="mb-4 form-group">
                                <label for="end-date" class="text-sm">End Date</label>
                                <input type="date" name="end_date" required class="form-control" id="end-date" placeholder="">
                            </div>
                            <div class="mb-4 form-group">
                                <label for="email" class="text-sm">E-mail</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                                    </svg>
                                </div> --}}
                                <input type="email" name="email" required class="form-control" id="email" placeholder="Email">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="country" class="text-sm">Country</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#flag" />
                                    </svg>
                                </div> --}}
                                <input name="" id="country" required name="country" class="form-control" list="countries" placeholder="Country">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="phone" class="text-sm">Phone Number</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                                    </svg>
                                </div> --}}
                                <input type="tel" name="phone" required class="block form-control" id="phone" placeholder="Phone No.">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="" class="text-sm">Message</label>
                                <textarea class="block form-control" required name="message" id="message" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="mb-4 form-group">
                                <input type="hidden" id="recaptcha" name="g-recaptcha-response">
                                @include('front.elements.recaptcha')
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>

                    <datalist id="countries">
                        <option value="Afghanistan">
                        <option value="Albania">
                        <option value="Algeria">
                        <option value="American Samoa">
                        <option value="Andorra">
                        <option value="Angola">
                        <option value="Anguilla">
                        <option value="Antarctica">
                        <option value="Antigua and Barbuda">
                        <option value="Argentina">
                        <option value="Armenia">
                        <option value="Aruba">
                        <option value="Australia">
                        <option value="Austria">
                        <option value="Azerbaijan">
                        <option value="Bahamas">
                        <option value="Bahrain">
                        <option value="Bangladesh">
                        <option value="Barbados">
                        <option value="Belarus">
                        <option value="Belgium">
                        <option value="Belize">
                        <option value="Benin">
                        <option value="Bermuda">
                        <option value="Bhutan">
                        <option value="Bolivia">
                        <option value="Bosnia and Herzegovina">
                        <option value="Botswana">
                        <option value="Bouvet Island">
                        <option value="Brazil">
                        <option value="British Indian Ocean Territory">
                        <option value="Brunei Darussalam">
                        <option value="Bulgaria">
                        <option value="Burkina Faso">
                        <option value="Burundi">
                        <option value="Cambodia">
                        <option value="Cameroon">
                        <option value="Canada">
                        <option value="Cape Verde">
                        <option value="Cayman Islands">
                        <option value="Central African Republic">
                        <option value="Chad">
                        <option value="Chile">
                        <option value="China">
                        <option value="Christmas Island">
                        <option value="Cocos (Keeling) Islands">
                        <option value="Colombia">
                        <option value="Comoros">
                        <option value="Congo">
                        <option value="Congo, The Democratic Republic of The">
                        <option value="Cook Islands">
                        <option value="Costa Rica">
                        <option value="Cote D'ivoire">
                        <option value="Croatia">
                        <option value="Cuba">
                        <option value="Cyprus">
                        <option value="Czech Republic">
                        <option value="Denmark">
                        <option value="Djibouti">
                        <option value="Dominica">
                        <option value="Dominican Republic">
                        <option value="Ecuador">
                        <option value="Egypt">
                        <option value="El Salvador">
                        <option value="Equatorial Guinea">
                        <option value="Eritrea">
                        <option value="Estonia">
                        <option value="Ethiopia">
                        <option value="Falkland Islands (Malvinas)">
                        <option value="Faroe Islands">
                        <option value="Fiji">
                        <option value="Finland">
                        <option value="France">
                        <option value="French Guiana">
                        <option value="French Polynesia">
                        <option value="French Southern Territories">
                        <option value="Gabon">
                        <option value="Gambia">
                        <option value="Georgia">
                        <option value="Germany">
                        <option value="Ghana">
                        <option value="Gibraltar">
                        <option value="Greece">
                        <option value="Greenland">
                        <option value="Grenada">
                        <option value="Guadeloupe">
                        <option value="Guam">
                        <option value="Guatemala">
                        <option value="Guinea">
                        <option value="Guinea-bissau">
                        <option value="Guyana">
                        <option value="Haiti">
                        <option value="Heard Island and Mcdonald Islands">
                        <option value="Holy See (Vatican City State)">
                        <option value="Honduras">
                        <option value="Hong Kong">
                        <option value="Hungary">
                        <option value="Iceland">
                        <option value="India">
                        <option value="Indonesia">
                        <option value="Iran, Islamic Republic of">
                        <option value="Iraq">
                        <option value="Ireland">
                        <option value="Israel">
                        <option value="Italy">
                        <option value="Jamaica">
                        <option value="Japan">
                        <option value="Jordan">
                        <option value="Kazakhstan">
                        <option value="Kenya">
                        <option value="Kiribati">
                        <option value="Korea, Democratic People's Republic of">
                        <option value="Korea, Republic of">
                        <option value="Kuwait">
                        <option value="Kyrgyzstan">
                        <option value="Lao People's Democratic Republic">
                        <option value="Latvia">
                        <option value="Lebanon">
                        <option value="Lesotho">
                        <option value="Liberia">
                        <option value="Libyan Arab Jamahiriya">
                        <option value="Liechtenstein">
                        <option value="Lithuania">
                        <option value="Luxembourg">
                        <option value="Macao">
                        <option value="Macedonia, The Former Yugoslav Republic of">
                        <option value="Madagascar">
                        <option value="Malawi">
                        <option value="Malaysia">
                        <option value="Maldives">
                        <option value="Mali">
                        <option value="Malta">
                        <option value="Marshall Islands">
                        <option value="Martinique">
                        <option value="Mauritania">
                        <option value="Mauritius">
                        <option value="Mayotte">
                        <option value="Mexico">
                        <option value="Micronesia, Federated States of">
                        <option value="Moldova, Republic of">
                        <option value="Monaco">
                        <option value="Mongolia">
                        <option value="Montserrat">
                        <option value="Morocco">
                        <option value="Mozambique">
                        <option value="Myanmar">
                        <option value="Namibia">
                        <option value="Nauru">
                        <option value="Nepal">
                        <option value="Netherlands">
                        <option value="Netherlands Antilles">
                        <option value="New Caledonia">
                        <option value="New Zealand">
                        <option value="Nicaragua">
                        <option value="Niger">
                        <option value="Nigeria">
                        <option value="Niue">
                        <option value="Norfolk Island">
                        <option value="Northern Mariana Islands">
                        <option value="Norway">
                        <option value="Oman">
                        <option value="Pakistan">
                        <option value="Palau">
                        <option value="Palestinian Territory, Occupied">
                        <option value="Panama">
                        <option value="Papua New Guinea">
                        <option value="Paraguay">
                        <option value="Peru">
                        <option value="Philippines">
                        <option value="Pitcairn">
                        <option value="Poland">
                        <option value="Portugal">
                        <option value="Puerto Rico">
                        <option value="Qatar">
                        <option value="Reunion">
                        <option value="Romania">
                        <option value="Russian Federation">
                        <option value="Rwanda">
                        <option value="Saint Helena">
                        <option value="Saint Kitts and Nevis">
                        <option value="Saint Lucia">
                        <option value="Saint Pierre and Miquelon">
                        <option value="Saint Vincent and The Grenadines">
                        <option value="Samoa">
                        <option value="San Marino">
                        <option value="Sao Tome and Principe">
                        <option value="Saudi Arabia">
                        <option value="Senegal">
                        <option value="Serbia and Montenegro">
                        <option value="Seychelles">
                        <option value="Sierra Leone">
                        <option value="Singapore">
                        <option value="Slovakia">
                        <option value="Slovenia">
                        <option value="Solomon Islands">
                        <option value="Somalia">
                        <option value="South Africa">
                        <option value="South Georgia and The South Sandwich Islands">
                        <option value="Spain">
                        <option value="Sri Lanka">
                        <option value="Sudan">
                        <option value="Suriname">
                        <option value="Svalbard and Jan Mayen">
                        <option value="Swaziland">
                        <option value="Sweden">
                        <option value="Switzerland">
                        <option value="Syrian Arab Republic">
                        <option value="Taiwan, Province of China">
                        <option value="Tajikistan">
                        <option value="Tanzania, United Republic of">
                        <option value="Thailand">
                        <option value="Timor-leste">
                        <option value="Togo">
                        <option value="Tokelau">
                        <option value="Tonga">
                        <option value="Trinidad and Tobago">
                        <option value="Tunisia">
                        <option value="Turkey">
                        <option value="Turkmenistan">
                        <option value="Turks and Caicos Islands">
                        <option value="Tuvalu">
                        <option value="Uganda">
                        <option value="Ukraine">
                        <option value="United Arab Emirates">
                        <option value="United Kingdom">
                        <option value="United States">
                        <option value="United States Minor Outlying Islands">
                        <option value="Uruguay">
                        <option value="Uzbekistan">
                        <option value="Vanuatu">
                        <option value="Venezuela">
                        <option value="Viet Nam">
                        <option value="Virgin Islands, British">
                        <option value="Virgin Islands, U.S">
                        <option value="Wallis and Futuna">
                        <option value="Western Sahara">
                        <option value="Yemen">
                        <option value="Zambia">
                        <option value="Zimbabwe">
                    </datalist>
                </div>
                <aside>
                    <div class="p-10 experts-card bg-light">
                        <div class="flex mb-6 experts-phone">
                            <a href="tel:" class="flex gap-6">
                                <div class="flex items-center justify-center w-10 h-10 rounded bg-primary">
                                    <svg class="w-6 h-6 text-white rounded">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-bold">We're located at</h2>
                                    {{ Setting::get('address') ?? '' }}
                                </div>
                            </a>
                        </div>
                        <div class="flex mb-6 experts-phone">
                            <a href="tel:{{ Setting::get('moblie1') ?? '' }}" class="flex gap-6">
                                <div class="flex items-center justify-center w-10 h-10 rounded bg-primary">
                                    <svg class="w-6 h-6 text-white rounded">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-bold">Call us</h2>
                                    {{ Setting::get('mobile1') ?? '' }}
                                </div>
                            </a>
                        </div>
                        <div class="flex mb-6 experts-phone">
                            <a href="mailto:{{ Setting::get('email') ?? '' }}" class="flex gap-6">
                                <div class="flex items-center justify-center w-10 h-10 rounded bg-primary">
                                    <svg class="w-6 h-6 text-white rounded">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-bold">Write to us</h2>
                                    {!! str_replace(['@', '.'], ['<wbr>@', '<wbr>.'], Setting::get('email') ?? '') !!} </br> envtrek@gmail.com </br> envtreks@gmail.com
                                </div>
                            </a>
                        </div>
                        <div class="mb-6 border-b border-gray-600"></div>
                        <div class="flex justify-center gap-4 bg-light">
                            <a href="{{ Setting::get('facebook') ?? '' }}" class="mr-1 text-primary hover:text-accent">
                                <svg class="w-8 h-8">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebookmessenger" />
                                </svg>
                            </a>
                            <a href="{{ Setting::get('viber') ?? '' }}" class="mr-1 text-primary hover:text-accent">
                                <svg class="w-8 h-8">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                                </svg>
                            </a>
                            <a href="{{ Setting::get('whatsapp') ?? '' }}" class="mr-1 text-primary hover:text-accent">
                                <svg class="w-8 h-8">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                                </svg>
                            </a>
                            <a href="{{ Setting::get('skype') ?? '' }}" class="mr-1 text-primary hover:text-accent">
                                <svg class="w-8 h-8">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#skype" />
                                </svg>
                            </a>
                            <a href="{{ Setting::get('weixin') ?? '' }}" class="mr-1 text-primary hover:text-accent">
                                <svg class="w-8 h-8">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#weixin" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

   <?= Setting::get('contactUs')['map'] ?? '' ?>

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
