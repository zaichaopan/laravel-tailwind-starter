<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Session\Store;
use App\Http\Requests\Places\Update;

class PlacesController extends Controller
{
    public function index()
    {
        $places = Place::paginate(10);

        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function show(Place $place)
    {
        return view('places.show', compact('place'));
    }

    public function store(Store $request)
    {
        $place = $request->persist();

        return redirect()->route('places.show', $place);
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    public function update(Place $place, Update $request)
    {
        $place = $request->persist();

        return redirect()->route('places.show', $place);
    }

    public function destroy(Place $place)
    {
        $place->prepareForDeletion()->delete();

        return redirect()->route('places.index');
    }
}
