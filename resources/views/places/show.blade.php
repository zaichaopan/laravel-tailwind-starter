@extends('layouts.app', ['title' => $place->address])
@section('app.content')

<div class="my-2">
    {{ $place->description }}
</div>

<div class="my-8">
    @include('comments.partials._comment', ['comments' => $comments])
    {{ $comments->links() }}
</div>
@endsection
