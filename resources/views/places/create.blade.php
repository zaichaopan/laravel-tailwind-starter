@extends('layouts.app', ['title' => 'Post your place'])
@section('app.content')

<div class="my-2">
    <place-form  action="{{route('places.store')}}"
                 upload-image-endpoint="{{ route('images.temp.destroy') }}"
                 delete-image-endpoint="{{ route('images.temp.destroy')}}">
    </place-form>
</div>
@endsection
