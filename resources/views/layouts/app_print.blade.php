<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'E-ISP') }}</title>

        <link href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/gif" rel="icon">

        <style>
            @page {
                margin: 0.1em 0.3em;
            }
            .fo14 {
                font-size: 14px;
            }
            .fo12 {
                font-size: 12px;
            }
            .fo9 {
                font-size: 9px;
            }
            .fo8 {
                font-size: 8px;
            }
            .fo7 {
                font-size: 7px;
            }
            .pd5 {
                padding: 5px;
            }
            .pdt6 {
                padding-top: 6px;
            }
            .bold {
                font-weight: bold;
            }
            hr {
                margin: 1px;
                border-width: thin;
            }
            .mgb3 {
                margin-bottom: 3px;
            }
            body {
                font-size: small;
                font-family: arial,sans-serif;
            }
        </style>

        @yield('header')
    </head>
    <body>
        <div id="container">
            @section('content')
                @show
        </div>

        @yield('footer')

    </body>
</html>
