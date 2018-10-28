<?php

namespace App\Http\Controllers;

use App\Place;
use App\Comment;

class PlaceCommentsController extends CommentsController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Place $place, $request)
    {
        $comment = new Comment($request->all());
        $comment->user()->associate($request->user());
        $place->comments()->save($comment);
        return back();
    }
}
