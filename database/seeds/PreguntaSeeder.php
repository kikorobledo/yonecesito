<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preguntas')->insert([
            'contenido' => '¿Que es lo que en realidad necesitas?',
            'tarea_id' => 1,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('preguntas')->insert([
            'contenido' => '¿Cuanto piensa pagar?',
            'tarea_id' => 1,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('preguntas')->insert([
            'contenido' => '¿Que es lo que en realidad necesitas?',
            'tarea_id' => 2,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('preguntas')->insert([
            'contenido' => '¿Se puede llegar a pie?',
            'tarea_id' => 2,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('preguntas')->insert([
            'contenido' => '¿Para cuanto necesita estar listo?',
            'tarea_id' => 4,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('preguntas')->insert([
            'contenido' => '¿Se ocupan herramientas?',
            'tarea_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
