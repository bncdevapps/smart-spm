<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            {{ isset($title) ? $title . " - " . str_replace('_', ' ', config('app.name')) : str_replace('_', ' ', config('app.name')) }}
        </title>
        <link type="text/plain" rel="author" href="{{ asset('credits.txt') }}" />

        <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
        <style>
            @import url('https://rsms.me/inter/inter.css');

            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-normal py-4">
                <div class="row align-items-center g-4">

                    {{ $slot }}

                </div>
            </div>
        </div>

        @livewireScripts
        <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

    </body>

</html>