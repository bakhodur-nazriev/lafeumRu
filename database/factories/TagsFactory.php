<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Tags;
use Faker\Generator as Faker;

$factory->define(App\Tags::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
    ];
});
