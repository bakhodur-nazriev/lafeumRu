<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\KnowledgeArea;
use Faker\Generator as Faker;

$factory->define(KnowledgeArea::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->sentences($nb = 3, $asText = false)
    ];
});
