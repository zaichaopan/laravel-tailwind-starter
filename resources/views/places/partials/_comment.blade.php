@php
  $nesting = $nesting ?? 1;
@endphp

<div id="{{$comment->id}}" class="mt-2">
  <strong> {{ $comment->user->name }}: </strong> {{ $comment->body }}

   @include('places.partials._form', ['action' => $action, 'parent_id' => $comment->id])

  <div id="{{ $comment->id }}_comments" class="border-l pl-4 mt-4 border-grey">
    @if(isset($continueThread) && $nesting >= $continueThread && $comment->comments->count())
      <div>Continue this thread</div>
    @else
      @foreach($comment->comments as $reply)
        @include('places.partials._comment', [
          'comment' => $reply,
          'nesting' => $nesting+1,
          'action' => $action
        ])
      @endforeach
    @endif
  </div>
</div>
