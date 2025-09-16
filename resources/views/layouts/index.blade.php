<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/js/app.js')

        <!-- Open Graph Meta Tags for Facebook -->
        <meta property="og:title" content="TCG Optimize">
        <meta property="og:description" content="Need to set a posting to a % of TCG Low? Don't want to calculate all the numbers manually? Use our TCG Low Percentage Tool! Paste your post with the numbers, and we'll do the number crunching for you :) (Rounded to the nearest 0.50)">
        <meta property="og:image" content="https://tcgoptimize.com/images/logo-white-background.png">
        <meta property="og:url" content="https://tcgoptimize.com">

        <!-- Twitter Card Meta Tags for Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="TCG Optimize">
        <meta name="twitter:description" content="Need to set a posting to a % of TCG Low? Don't want to calculate all the numbers manually? Use our TCG Low Percentage Tool! Paste your post with the numbers, and we'll do the number crunching for you :) (Rounded to the nearest 0.50)">
        <meta name="twitter:image" content="https://tcgoptimize.com/images/logo-white-background.png">
        <meta name="twitter:url" content="https://tcgoptimize.com">

        @if(config('analytics.view_id'))
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('analytics.view_id') }}"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '{{ config('analytics.view_id') }}');
            </script>
        @endif

        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8314357925637916"
     crossorigin="anonymous"></script>
        
        <title>TCG Optimize - @yield('title')</title>
    </head>   
    <body class="flex flex-col min-h-screen font-sans">

        @include('layouts.header')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('layouts.footer')

    </body>

</html>