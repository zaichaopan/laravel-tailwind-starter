<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
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
        $places = Place::paginate(10);
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function show(Place $place, Request $request)
    {
        return view('places.show', compact('place'));
    }

    public function store(Store $request)
    {
        $place = $request->persist();
        event(new PlaceWasCreated($place));
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
        $place->delete();
        return redirect()->route('places.index');
    }
}
