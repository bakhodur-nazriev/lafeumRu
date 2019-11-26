<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Photos::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl()
    ];
});
