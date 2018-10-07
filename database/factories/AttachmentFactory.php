<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Attachment::class, function (Faker $faker) {
    return [
        'path' => Str::random(40),
        'extension' => $faker->randomElement(['jpg', 'png', 'pdf'], 1),
        'size' => rand(1000, 2000),
        'name' => Str::random(40)
    ];
});
