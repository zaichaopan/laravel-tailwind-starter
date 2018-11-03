@extends('layouts.app', ['title' => $place->address])
@section('app.content')

<div class="my-2 px-2 md:px-0">
    {{ $place->description }}
</div>

<form action="">

<label class="form-label">First name</label>
<input type="text" class="form-input">


<label class="form-checkbox">
<input type="checkbox" class="form-checkbox-input" name="vehicle1" value="Bike"> hello
</label>


</form>

<div class="my-2 px-2 md:px-0">
    <comment-list :comments="{{ json_encode($comments) }}"></comment-list>
</div>

@endsection
