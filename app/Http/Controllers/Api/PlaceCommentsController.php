<?php

namespace App\Http\Controllers\Api;

use App\Place;
use Illuminate\Http\Request;
use App\NestedCommentsService;
use App\Http\Controllers\Controller;

class PlaceCommentsController extends Controller
{
    public function index(Place $place, Request $request)
    {
        $comments = (new NestedCommentsService($place, $request))->paginate(15);

        return response()->json(['data' => $comments]);
    }
}
