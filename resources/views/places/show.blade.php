@extends('layouts.app', ['title' => $place->address])
@section('app.content')

<div class="my-2 px-2 md:px-0">
    {{ $place->description }}
</div>

<div class="my-2 px-2 md:px-0">
    <comment-list :comments="{{ json_encode($comments) }}"></comment-list>
</div>

@endsection
