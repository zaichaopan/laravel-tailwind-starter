<?php

namespace App\Http\Controllers;

use App\Place;
use App\Events\PlaceWasCreated;
use App\Http\Requests\Places\{Store, Update};

class PlacesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('owner:place')->only(['edit', 'update', 'destroy']);
    }

    public function index()
    {
        return view('places.index', ['places' => Place::paginate(10)]);
    }

    public function create()
    {
        return view('places.create');
    }

    public function show(Place $place)
    {
        $comments = $place->comments()->whereNull('parent_id')->paginate(2);

        return view('places.show', [
            'place' => $place,
            'comments' => $comments
       ]);
    }

    public function store(Store $request)
    {
        $place = $request->persist();
        event(new PlaceWasCreated($place));
        return redirect()->route('places.show', $place);
    }

    public function edit(Place $place)
    {
        return view('places.edit', ['place' => $place]);
    }

    public function update(Place $place, Update $request)
    {
        return redirect()->route('places.show', ['place' => $request->persist()]);
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('places.index');
    }
}
