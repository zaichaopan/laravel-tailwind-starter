<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name') }} - @yield('title')</title>
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body class="font-sans bg-grey-lightest">
    <div id="app">
        <div class="w-full">
            <div class="flex flex-col">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @yield('scripts')
</body>

</html>
