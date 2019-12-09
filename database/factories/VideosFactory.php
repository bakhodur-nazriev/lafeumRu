<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
// use App\Model;
use App\Video;
use Faker\Generator as Faker;

function getRandomId($collection, $exceptions = [])
{
    return $collection->except($exceptions)->random()->id;
}

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'channel_id' => getRandomId(Channel::all()),
        'link' => $faker->url(),
        'duration' => $faker->randomDigitNotNull()
    ];
});
