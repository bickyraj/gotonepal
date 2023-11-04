<div class="p-4 bg-white">
    <div class="flex justify-between gap-4">
        <div class="col-span-2">
            <p class="mb-0 font-handwriting">Still confused?</p>
            <h3 class="mb-2 text-lg">Talk to our experts</h3>
        </div>
        <svg class="flex-shrink-0 w-16 h-16 rounded-full text-primary bg-light">
            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#customersupport" />
        </svg>
    </div>
    <div class="flex mb-1 experts-phone">
        <a href="{{ Setting::get('mobile1') }}" class="flex items-center gap-2 text-sm">
            <svg class="w-5 h-5 text-primary">
                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
            </svg>
            {{ Setting::get('mobile1') }}
        </a>
    </div>
    <div class="flex mb-3 experts-phone">
        <a href="mailto:{{ Setting::get('email') }}" class="flex items-center gap-2 text-sm">
            <svg class="w-5 h-5 text-primary">
                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
            </svg>
            {{ Setting::get('email') }}
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