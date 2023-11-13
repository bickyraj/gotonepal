<div class="p-4 bg-white">
    <p class="mb-0 text-lg font-handwriting">Still confused?</p>
    <h3 class="mb-2 text-2xl font-bold font-display text-primary">Talk to our experts</h3>
    <div class="flex justify-center"><img src="{{ asset('assets/front/img/support.webp')}}" alt="" class="w-48 mb-6"></div>
    <div class="flex mb-2 experts-phone">
        <a href="{{ Setting::get('mobile1') }}" class="flex items-center gap-2 text-sm">
            <div class="flex items-center justify-center w-8 h-8 rounded bg-accent">
                <svg class="w-5 h-5 text-white">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                </svg>
            </div>
            <div>
                <div class="font-bold text-gray-600">Call us</div>
                <span class="text-lg">{{ Setting::get('mobile1') }}</span>
            </div>
        </a>
    </div>
    <div class="flex mb-4 experts-phone">
        <a href="mailto:{{ Setting::get('email') }}" class="flex items-center gap-2 text-sm">
            <div class="flex items-center justify-center w-8 h-8 rounded bg-accent">
                <svg class="w-5 h-5 text-white">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                </svg>
            </div>
            <div>
                <div class="font-bold text-gray-600">Write to us</div>
                <span class="text-lg">{{ Setting::get('email') }}</span>
            </div>
        </a>
    </div>
</div>
    
<div class="flex justify-center gap-4 p-2 mb-8 bg-light">
    <a href="{{ Setting::get('facebook') }}" class="mr-1 text-primary hover:text-accent">
        <svg class="w-6 h-6">
            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebookmessenger" />
        </svg>
    </a>
    <a href="{{ Setting::get('viber') }}" class="mr-1 text-primary hover:text-accent">
        <svg class="w-6 h-6">
            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
        </svg>
    </a>
    <a href="{{ Setting::get('whatsapp') }}" class="mr-1 text-primary hover:text-accent">
        <svg class="w-6 h-6">
            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
        </svg>
    </a>
    <a href="{{ Setting::get('skype') }}" class="mr-1 text-primary hover:text-accent">
        <svg class="w-6 h-6">
            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#skype" />
        </svg>
    </a>
</div>