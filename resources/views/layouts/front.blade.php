<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Setting::get('homePageSeo')['meta_title'] ?? '' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- meta tags --}}
    <meta name="description" content="{{ Setting::get('homePageSeo')['og_description'] ?? '' }}" />
    <meta name="keywords" content="{{ Setting::get('homePageSeo')['meta_keywords'] ?? '' }}" />
    <link rel="canonical" href="{{ url('/') }}" />
    <meta property="og:title" content="{{ Setting::get('homePageSeo')['og_title'] ?? '' }}" />
    <meta property="og:url" content="https://www.gotonepal.com" />
    <meta property="og:site_name" content="{{ Setting::get('homePageSeo')['meta_title'] ?? '' }}" />
    <meta property="og:image" content="{{ Setting::getSiteSettingImage(Setting::get('homePageSeo')['og_image'] ?? null) }}" />
    <meta property="og:description" content="{{ Setting::get('homePageSeo')['og_description'] ?? '' }}" />
    <meta property="fb:app_id" content="" />
    <meta property="og:image" content="@yield('meta_og_image')" />
    <meta property="og:description" content="@yield('meta_og_description')" />
    <meta name="IndexType" content="trekking in Nepal" />
    <meta name="language" content="EN-US" />
    <meta name="type" content="Trekking" />
    <meta name="classification" content="" />
    <meta name="company" content="" />
    <meta name="author" content="" />
    <meta name="contact person" content="" />
    <meta name="copyright" content="" />
    <meta name="security" content="public" />
    <meta content="all" name="robots" />
    <meta name="document-type" content="Public" />
    <meta name="category" content="Trekking in Nepal" />
    <meta name="robots" content="all,index" />
    <meta name="googlebot" content="INDEX, FOLLOW" />
    <meta name="YahooSeeker" content="INDEX, FOLLOW" />
    <meta name="msnbot" content="INDEX, FOLLOW" />
    <meta name="allow-search" content="Yes" />
    <meta name="doc-rights" content="" />
    <meta name="doc-publisher" content="" />
    <meta name="p:domain_verify" content="" />
    {{-- end of meta tags --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://code.jquery.com">
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://www.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    {{-- Preload --}}
    {{-- Preload css and js assets except those not needed immediately --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css" as="style">
    <link rel="preload" href="{{ asset('assets/front/css/tw.css') }}" type="text/css" as="style">
    <link rel="preload" href="{{ asset('assets/front/css/app.css') }}" type="text/css" as="style">

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js" type="text/javascript" as="script">
    <link rel="preload" href="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript" as="script">
    <link rel="preload" href="{{ asset('assets/js/toastr-option.js') }}" type="text/javascript" as="script">

    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,400&family=Mulish:wght@700&family=Solitreo&display=swap" rel="stylesheet">

    {{-- Smartmenus --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css" type="text/css">

    <link rel="stylesheet" href="{{ asset('assets/front/css/tw.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/front/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/general/toastr/build/toastr.min.css') }}" type="text/css">

    @stack('styles')

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://www.gotonepal.com/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "https://query.gotonepal.com/search?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body class="text-gray-600 selection:bg-green-200 selection:text-gray-800" x-data="{ trips: [] }">
    <!-- scrollspy for tour-details page -->

    <!-- Header -- Topbar & Navbar-->
    @include('front.elements.header')
    {{-- end of header --}}

    <div id="topIO"></div>

    @yield('content')

    <!-- Footer -->
    @include('front.elements.footer')
    {{-- end of footer --}}

    <!-- Scripts -->
    <!-- App.js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/dist/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/toastr-option.js') }}" type="text/javascript"></script>
    <script>
        // Initialize jQuery Smartmenus
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var status = jqXHR.status;
                    if (status == 404) {
                        toastr.warning("Element not found.");
                    } else if (status == 422) {
                        toastr.info(jqXHR.responseJSON.message);
                    }
                }
            });
        });
    </script>
    @stack('scripts')
    <script>
        const header = document.querySelector('header')
        {{-- Change header on scroll --}}
        const headerScrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    header.classList.remove('scrolled')
                } else {
                    header.classList.add('scrolled')
                }
            })
        }, {
            rootMargin: "40px 0px 0px 0px"
        })
        headerScrollObserver.observe(document.querySelector('#topIO'))
    </script>
    <!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "9851031532", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "whatsapp", // Order of buttons
        };
        var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->

</body>

</html>
