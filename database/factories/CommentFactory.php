<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'owner' => $faker->name,
        'content' => $faker->realText(rand(50, 150)),
        'type' => 1
    ];
});
