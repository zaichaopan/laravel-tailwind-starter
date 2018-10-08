@extends('layouts.app', ['title' => 'Post your place'])
@section('app.content')

<div class="my-2">
    <place-form
        action="{{route('places.store')}}"
        upload-image-endpoint="{{ route('images.tmp.store') }}"
        delete-image-endpoint="{{ route('images.tmp.destroy')}}"
        :errors="{{ json_encode($errors->all()) }}">
    </place-form>
</div>
@endsection
