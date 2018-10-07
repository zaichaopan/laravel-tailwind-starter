<?php

use Faker\Generator as Faker;

$factory->define(App\Place::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
       'address' => $faker->address,
       'lat' => $faker->latitude,
       'lng' => $faker->longitude,
       'description' => $faker->paragraphs(rand(1,5), true),
    ];
});
