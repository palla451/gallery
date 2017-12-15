<?php

use Faker\Generator as Faker;
use App\Album;
use App\User;

$factory->define(Album::class, function (Faker $faker) {

    return [
        'album_name' => $faker->name,
        'album_thumb' => $faker->imageUrl(240, 240, 'cats'),
        'user_id' => User::inRandomOrder()->first(),
        'description' => $faker->text($maxNbChars = 200),
    ];
});
