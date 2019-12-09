<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use Faker\Generator as Faker;

$factory->define(App\Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->text(80)
    ];
});
