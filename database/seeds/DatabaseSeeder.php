<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Subject::class, 10)->create();
        
        factory(App\Faculty::class, 3)->create()->each(function ($f) {
        	factory(App\Degree::class, 3)->create([
        		'faculty_slug' => $f->slug
        	])->each(function ($d) {
                $faker = Faker\Factory::create();
                factory(App\Participant::class)->create([
                    'id' => $faker->unique()->randomDigit,
                    'degree_slug' => $d->slug
                ]);
            });
        });
    }
}
