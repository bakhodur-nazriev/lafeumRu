<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorite;
use App\User;
use App\Quote;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'quote_id' => getRandomId(Quote::all()),
        'user_id' => getRandomId(User::all())
    ];
});
