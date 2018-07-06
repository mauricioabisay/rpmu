<?php

use Faker\Generator as Faker;

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'description' => $faker->paragraph(1),
    ];
});
