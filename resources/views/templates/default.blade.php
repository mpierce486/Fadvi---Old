<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="google-site-verification" content="vdqZT8RiZTDcTFXACoyiBXEAAPJt_b-DZp2fije1SLM" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="{{ asset('images/favicon/favicon-32x32.png') }}" type="image/x-icon" />

        @if (Route::current()->getName() === 'blog.post')
            <title>Fadvi | @yield('pageTitle')</title>
            <meta name="description" content="@yield('pageDescription')">
        @else
            <title>Fadvi | Financial Advice For the Next Generation</title>
            <meta name="description" content="Financial advice for the next generation.">
        @endif

        <!-- StyleSheets -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/v4-shims.css">
        

        <!-- JavaScript -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
        <script>window.Fadvi = <?= Auth::check() ? json_encode(['user' => Auth::user()->first_name]) : "" ?></script>

        <!-- TinyMCE -->

        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5z6xgvxfz4bezwgokadopiu34i5gcl6joohltyy689mwckj2"></script>

        <!-- SweetAlert2 -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.11/sweetalert2.all.min.js"></script>
        <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    </head>
    <body>

        <!-- INCLUDE NAVIGATION BAR TEMPLATE -->
        @if (Route::current()->getName() === 'index')
            @include('templates.partials.navigation')
        @else
            @include('templates.partials.navigation-secondary')
        @endif

        
            @yield('content')
        
        
        <!-- INCLUDE FOOTER SECTION TEMPLATE -->
        @if (Route::current()->getName() !== 'results')
            @include('templates.partials.footer')
        @endif

        
    </body>
</html>
