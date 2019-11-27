<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\KnowledgeAreas;
use Faker\Generator as Faker;

$factory->define(KnowledgeAreas::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->sentences($nb = 3, $asText = false)
    ];
});
