<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Term;
use Faker\Generator as Faker;

$factory->define(Term::class, function (Faker $faker) {
    return [
        // 'body' => $faker->name,
    ];
});
