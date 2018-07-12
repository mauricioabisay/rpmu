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

        //
        $title = 'Ciencias Económico Administrativas';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => $slug
        ]);
        $degrees = array(
            'Administración de Empresas',
            'Administración Financiera y Bursátil',
            'Comercio y Estrategia Internacional',
            'Contaduría y Alta Dirección',
            'Dirección de Hospitalidad y Turismo',
            'Gastronomía',
            'Inteligencia de Negocios',
            'Logística de Negocios',
            'Mercadotecnia'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }
        
        //
        $title = 'Ingenierías';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => $slug
        ]);
        $degrees = array(
            'Ingeniería Aeroespacial',
            'Ingeniería Biónica',
            'Ingeniería Civil',
            'Ingeniería de Software',
            'Ingeniería Electrónica y Telecomunicaciones',
            'Ingeniería en Computación y Sistemas',
            'Ingeniería en Diseño Automotriz',
            'Ingeniería en Tecnologías de Información y Ciencia de Datos',
            'Ingeniería Industrial',
            'Ingeniería Mecatrónica',
            'Ingeniería Química Industrial'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }

        //
        $title = 'Artes y Humanidades';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => $slug
        ]);
        $degrees = array(
            'Arquitectura',
            'Diseño Gráfico y Digital',
            'Diseño y Producción Publicitaria',
            'Filosofía',
            'Humanidades y Gestión Cultural',
            'Pedagogía e Innovación Educativa',
            'Psicología',
            'Psicopedagogía'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }

        //
        $title = 'Ciencias Sociales';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => $slug
        ]);
        $degrees = array(
            'Administración',
            'Gobierno y Políticas Públicas',
            'Ciencias Políticas,Cine y Producción Audiovisual',
            'Comunicación y Medios Digitales',
            'Derecho',
            'Economía',
            'Relaciones Internacionales'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }

        //
        $title = 'Ciencias de la Salud';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => $slug
        ]);
        $degrees = array(
            'Enfermería',
            'Fisioterapia',
            'Medicina',
            'Nutrición',
            'Odontología'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }

        //
        $title = 'Ciencias Biológicas';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => str_slug($title)
        ]);
        $degrees = array(
            'Ingeniería Ambiental',
            'Ingeniería en Agronomía',
            'Ingeniería en Biotecnología',
            'Medicina Veterinaria y Zootecnia'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }

        //
        $title = 'Estudios de Lengua y Cultura';
        $slug = str_slug($title);
        factory(App\Faculty::class)->create([
            'title' => $title,
            'slug' => $slug
        ]);
        $degrees = array(
            'Idiomas, Enseñanza y Diversidad Cultural'
        );
        foreach ($degrees as $d) {
            factory(App\Degree::class)->create([
                'title' => $d,
                'slug' => str_slug($d),
                'faculty_slug' => $slug
            ]);
        }


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
                App\Participant::whereNotNull('user_id')->get()->random()->id, 
                [
                    'role' => 'leader',
                    'assigment' => ''
                ]
            );
        });
    }
}
