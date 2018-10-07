<?php

namespace App\Events;

use App\Place;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PlaceWasCreated
{
    use Dispatchable, SerializesModels;

    public $place;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Place $place)
    {
        $this->place = $place;
    }
}
