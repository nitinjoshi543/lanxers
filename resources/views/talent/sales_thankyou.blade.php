<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lanxers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}?v={{ filemtime(public_path('frontend/css/global.css')) }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/thank-you.css') }}?v={{ filemtime(public_path('frontend/css/thank-you.css')) }}" />

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '2155136948743561');
    fbq('track', 'Lead');
    </script>

    <noscript>
    <img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2155136948743561&ev=Lead&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <section class="thank-you-page">
        <img class="banner-leftimg" src="assets/images/opport-bg1.png" alt="">
        <div class="cicrule-box1"></div>
        <div class="cicrule-box2"></div>
        <div class="container-fluid">
            <div class="thank-you">
                <div class="badge">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 12.5l5 5L20 7" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <h1>Thank You!</h1>
                <p>For submitting your details. Your information has been received successfully. We’ll be in touch when a suitable opportunity comes your way.</p>

            </div>
        </div>
    </section>

    <script>
        setTimeout(function() {
            window.location.href = "https://lanxers.com/jobseekers/find-work#job-74";
        }, 15000);
    </script>

</body>

</html>