<?php

use Faker\Generator as Faker;

$factory->define(App\Goal::class, function (Faker $faker) {
    return [
        'title' => $faker->text(),
        'description' => $faker->paragraph(1),
        'achieve' => $faker->boolean()
    ];
});
