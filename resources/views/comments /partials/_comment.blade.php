<?php
    $traverse = function ($comments) use (&$traverse) {
        foreach ($comments as $comment):
?>

    <div class='comment'>
        <h4>
            {{ $comment->user->name }} @if ($comment->parent_id)
            <small>In reply to {{ $comment->parent->user->name}} </small> @endif
        </h4>

        <p> {{ $comment->body }} </p>

        @if ($comment->children)
        <?php $traverse($comment->children) ?> @endif
    </div>

    <?php
    endforeach;
}

 $traverse($comments);
?>
