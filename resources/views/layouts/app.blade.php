<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="Jj Gesulgon" />
    <meta property="og:description" content="Fullstack Web Developer and Software Engineer" />
    <meta property="og:image" content="{{ URL::asset('/assets/meta_image.jpg') }}" />
    {{-- <meta property="og:image" content="https://www.jjgesulgon.dev/assets/meta_image.jpg" /> --}}
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="https://www.jjgesulgon.dev" />
    <meta property="og:site_name" content="Jj Gesulgon Website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:author" content="Jj Gesulgon" />
    <meta property="fb:app_id" content="298535204508955" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ URL::asset('/assets/favicon.ico') }}" type="image/x-icon"/>
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>JJ Gesulgon</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
