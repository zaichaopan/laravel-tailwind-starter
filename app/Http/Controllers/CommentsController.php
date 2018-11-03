<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id, Request $request)
    {
        $comment = new Comment($request->all());
        $comment->user()->associate($request->user());
        $commentable = (new $this->setCommentable())->find($id);
        $commentable->comments()->save($comment);
        return back();
    }

    public function destroy($id, Request $request)
    {
        $comment = (new $this->setCommentable())->firstOrFail();
        abort_unless($request->user()->owns($comment), 403);
        // soft delete
        $comment->delete();
        return response()->json([]);
    }

    abstract protected function setCommentable();
}
