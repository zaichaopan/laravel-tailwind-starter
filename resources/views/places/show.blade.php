@extends('layouts.app', ['title' => $place->address])
@section('app.content')

<div class="my-2">
    {{ $place->description }}
</div>

<div class="my-2">
    <comment-list :comments="{{ json_encode($comments) }}"></comment-list>
</div>

@endsection
