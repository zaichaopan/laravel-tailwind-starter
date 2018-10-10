@extends('layouts.app', ['title' => 'Upate your place'])
@section('app.content')

<div class="my-2 p-2 xs:p-0">
    <place-form
        method="Post"
        action="{{ route('places.update', $place) }}"
        upload-image-endpoint="{{ route('places.images.store', $place) }}"
        delete-image-endpoint="{{ route('places.images.destroy', $place) }}"
        :place="{{ json_encode($place) }}"
        :erros="{{ json_encode($errors->all()) }}">
    </place-form>
</div>
@endsection
