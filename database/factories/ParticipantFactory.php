<?php

use Faker\Generator as Faker;

$factory->define(App\Participant::class, function (Faker $faker) {
	$name = $faker->name;
	$slug = str_slug($name);
    return [
    	'id' => $faker->unique()->ean8,
        'name' => $name,
        'slug' => $slug,
        'bio' => $faker->paragraph(3),
        'link' => $faker->url,
        'degree_slug' => App\Degree::all()->random()->slug,
    ];
});
