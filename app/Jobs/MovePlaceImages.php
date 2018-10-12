<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Events\PlaceWasCreated;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MovePlaceImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
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
