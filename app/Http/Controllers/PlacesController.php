<?php

namespace App\Http\Controllers;

class PlacesController extends Controller
{
    public function create()
    {
        return view('places.create');
    }

    public function store()
    {
    }
}
