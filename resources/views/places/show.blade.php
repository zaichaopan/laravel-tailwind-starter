@extends('layouts.app', ['title' => $place->address]) 
@section('app.content')

<div class="my-2">
    {{ $place->description }}
</div>
@endsection
