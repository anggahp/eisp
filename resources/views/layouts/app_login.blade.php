<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-ISP') }}</title>

        <!-- Styles -->
        <link href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/gif" rel="icon">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/customs/login.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/pace/css/pace-theme-flash.css') }}" rel="stylesheet">

        @yield('header')
    </head>
    <body>
         @yield('content')

        <!-- Scripts -->
        <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('assets/pace/js/pace.min.js') }}"></script>

        @yield('footer')
    </body>
</html>
