<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-ISP') }}</title>

        <link href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/gif" rel="icon">
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/dataTables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/pace/css/pace-theme-flash.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/toastr/css/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/sweetalert/sweetalert2.min.css')}}">

        @yield('header')
    </head>
    <body>
        <div id="wrapper">
            @include('layouts.include.header')
            {{-- @include('mdashboard.partials.message') --}}
            
            @section('content')
                @show
            <!-- /.main-container -->

            @include('layouts.include.footer')
        </div>

        <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/dataTables/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/pace/js/pace.min.js') }}"></script>
        <script src="{{ asset('assets/toastr/js/toastr.min.js') }}"></script>
        <script src="{{asset('assets/sweetalert/sweetalert2.min.js')}}"></script>
        <script>
            paceOptions = {
                elements: true
            };
            $(document).ready(function(){
                
                $("[data-tooltip=tooltip]").tooltip({ boundary: 'window' });
            });
        </script>

        <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
        <!-- include custom script for site  -->
        <script src="{{ asset('assets/js/main.min.js') }}"></script>

        @yield('footer')

    </body>
</html>
