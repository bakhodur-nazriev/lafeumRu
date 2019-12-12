<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Author;
use App\Quote;
use Faker\Generator as Faker;

function getRandomId($collection, $exceptions = [])
{
    return $collection->except($exceptions)->random()->id;
}

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'body' => $faker->text(160),
        'author_id' => getRandomId(Author::all())
    ];
});
