<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Channels::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->paragraph(rand(2, 8), true)
    ];
});
