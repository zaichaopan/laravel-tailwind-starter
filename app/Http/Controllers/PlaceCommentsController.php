<?php

namespace App\Http\Controllers;

use App\Place;

class PlaceCommentsController extends CommentsController
{
    protected function setCommentable()
    {
        return  Place::class;
    }
}
