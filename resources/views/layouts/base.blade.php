<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.partials._meta')
    @yield('head.scripts')
    @yield('head.links')
    @include('layouts.partials._analytics')
</head>

<body>
    <div class="flex flex-col min-h-screen font-sans text-black bg-black font-base">
        <div id="app" class="flex flex-col font-sans min-h-screen bg-white">
            @yield('base.content')
            @includeWhen($includingFooter, 'layouts.partials._footer')
        </div>
    </div>
    @yield('footer.scripts')
</body>

</html>
