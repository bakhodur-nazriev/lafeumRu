<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Knowledge;
use Faker\Generator as Faker;

$factory->define(Knowledge::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->text()
    ];
});
