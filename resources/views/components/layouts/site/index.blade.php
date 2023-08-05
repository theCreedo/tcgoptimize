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

        <title>TCG Optimize</title>
    </head>   
    <body class="flex flex-col min-h-screen font-sans">
        
        <x-layouts.site.header />

        <main class="flex-grow">
            {{ $slot }}
        </main>

        <x-layouts.site.footer />

    </body>

</html>