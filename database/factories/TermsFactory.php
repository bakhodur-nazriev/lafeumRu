<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Terms;
use Faker\Generator as Faker;

$factory->define(Terms::class, function (Faker $faker) {
    return [
        // 'body' => $faker->name,
    ];
});
