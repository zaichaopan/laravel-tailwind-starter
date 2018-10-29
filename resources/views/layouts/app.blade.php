@extends('layouts.base', ['includingFooter' => true])
@section('head.scripts')
<script src="{{ asset('js/app.js') }}" defer></script>

<script>
    window.App = {!! json_encode([
                'csrfToken' => csrf_token(),
                'user' => Auth::user(),
                'googleMapKey' => env('GOOGLE_MAP_KEY')
            ]) !!};

</script>
@endsection

@section('head.links')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('base.content')
    @include('layouts.partials._nav')
<div class="container mx-auto flex flex-col flex-1">
    @yield('app.content')
</div>
@endsection
