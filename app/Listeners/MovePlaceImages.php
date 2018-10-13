<?php

namespace App\Listeners;

use App\Events\PlaceWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class MovePlaceImages implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PlaceWasCreated $event)
    {
        $event->place
            ->images
            ->each
            ->move($event->place->imageRootDir());
    }
}
