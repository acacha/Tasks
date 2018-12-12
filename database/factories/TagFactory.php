<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'color' => $faker->hexColor
    ];
});
