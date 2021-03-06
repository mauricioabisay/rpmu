<?php

use Faker\Generator as Faker;

$factory->define(App\Faculty::class, function (Faker $faker) {
	$title = $faker->sentence(3);
	$slug = str_slug($title); 
    return compact('title', 'slug');
});
