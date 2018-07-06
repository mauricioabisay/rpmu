<?php

use Faker\Generator as Faker;

$factory->define(App\Goal::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'description' => $faker->paragraph(1),
        'achieve' => $faker->boolean()
    ];
});
