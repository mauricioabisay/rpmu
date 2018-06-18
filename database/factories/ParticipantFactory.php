<?php

use Faker\Generator as Faker;

$factory->define(App\Participant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'bio' => $faker->paragraph(3),
        'link' => $faker->url,
    ];
});
