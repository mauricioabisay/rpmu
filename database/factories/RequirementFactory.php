<?php

use Faker\Generator as Faker;

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
        'title' => $faker->text(),
        'description' => $faker->paragraph(1),
    ];
});
