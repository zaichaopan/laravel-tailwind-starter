<?php

use Illuminate\Database\Seeder;

class PlaceCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $place = factory('App\Place')->create();

        $comments = factory('App\Comment', 100)->make()->each(function ($comment) use ($place) {
            $comment->replies()->saveMany($this->createNestedReplies($place, $comment, 4));
        });

        $place->comments()->saveMany($comments);
    }

    protected function createNestedReplies($place, $comment, $depth, $currentDepth = 0)
    {
        if ($currentDepth === $depth) {
            return ;
        }

        return $comment->replies()->saveMany(
            factory('App\Comment', 3)->make()->each(function ($reply) use ($place, $depth, $currentDepth) {
                $place->comments()->save($reply);
                $this->createNestedReplies($place, $reply, $depth, ++$currentDepth);
            })
        );
    }
}
