<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class CommentsController extends Controller
{
    protected $commentable;

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->setCommentable($request);
    }

    public function create($request)
    {
    }

    abstract protected function setCommentable(Request $request);
}
