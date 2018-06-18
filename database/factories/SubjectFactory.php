<?php

use Faker\Generator as Faker;

$factory->define(App\Subject::class, function (Faker $faker) {
    	$title = $faker->sentence(5);
    	$slug = str_slug($title); 
        return compact('title', 'slug');
});
