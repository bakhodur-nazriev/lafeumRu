<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Authors;
use Faker\Generator as Faker;

$factory->define(Authors::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'biography' => $faker->sentence(),
        'photo' => $faker->imageUrl()
    ];
});
