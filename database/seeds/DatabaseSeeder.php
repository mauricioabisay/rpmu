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
        	]);
        });


        factory(App\Participant::class, 10)->create();

        factory(App\Participant::class)->create([
            'id' => '24400004',
            'name' => 'MAURICIO ABISAY LOPEZ VELAZQUEZ',
            'slug' => 'mauricio_abisay_lopez_velazquez',
            'user_id' => factory(App\User::class)->create([
                'email' => 'mauricioabisay.lopez@upaep.edu.mx',
                'role' => 'admin'
            ])->id
        ]);

        factory(App\Participant::class)->create([
            'id' => '24400005',
            'name' => 'MAURICIO ABISAY',
            'slug' => 'mauricio_abisay',
            'user_id' => factory(App\User::class)->create([
                'email' => 'mauricioabisay.lopez@gmail.com',
                'role' => 'admin'
            ])->id
        ]);

        factory(App\Research::class, 20)->create()->each(function ($r) {
            factory(App\Goal::class, 5)->create([
                'research_id' => $r->id
            ]);
            factory(App\Requirement::class, 5)->create([
                'research_id' => $r->id
            ]);
        });

        App\Research::all()->each(function ($r) {
            $r->participants()->attach(
                App\Participant::all()->random()->id, 
                [
                    'role' => 'leader',
                    'assigment' => ''
                ]
            );
        });
    }
}
