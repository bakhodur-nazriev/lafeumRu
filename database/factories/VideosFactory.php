<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channels;
use App\Model;
use App\Videos;
use Faker\Generator as Faker;

function getRandomId($collection, $exceptions = [])
{
    return $collection->except($exceptions)->random()->id;
}

$factory->define(Videos::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'channel_id' => getRandomId(Channels::all()),
        'link' => $faker->url(),
        'duration' => $faker->randomDigitNotNull()
    ];
});
