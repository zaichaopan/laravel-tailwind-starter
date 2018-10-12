@extends('layouts.app', ['title' => $place->address]) 
@section('app.content')

<div class="my-2">
    {{ $place->description }}
</div>

<div class="my-8">
    <comment-list fetch-endpoint="{{ route('places.comments.index', $place) }}">
    </comment-list>
</div>
@endsection
