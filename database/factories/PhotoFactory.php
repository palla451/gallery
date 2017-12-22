<?php

use Faker\Generator as Faker;
use App\Photo;
use App\Album;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'album_id' => Album::inRandomOrder()->first(),
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'img_path' => $faker->imageUrl(240, 240, 'cats'),
    ];
});
