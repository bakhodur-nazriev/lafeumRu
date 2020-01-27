<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'image' => "https://placekitten.com/640/360",
        'description' => $faker->text(50)
    ];
});
