<?php

use Faker\Generator as Faker;

$factory->define(App\Research::class, function (Faker $faker) {
	$title = $faker->text();
	$slug = str_slug($title);
    return [
    	'slug' => $slug,
    	'title' => $title,
    	'abstract' => $faker->paragraph(1),
    	'status' => $faker->randomElement(['created', 'started', 'completed']),
    	'subject' => App\Subject::all()->random()->slug,
    	'description' => $faker->paragraph(3),
    	'extra_info' => '',
    ];
});
