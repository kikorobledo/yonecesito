<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResenalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resenas')->insert([
            'tipo' => 'Ofertante',
            'contenido' => 'Muy buen trato todo salio a lo acordado, lo recomiendo',
            'perfil_id' => 1,
            'user_id' => 2
        ]);

        DB::table('resenas')->insert([
            'tipo' => 'Trabajador',
            'contenido' => 'Trabajo muy bien termino todo',
            'perfil_id' => 1,
            'user_id' => 3
        ]);

        DB::table('resenas')->insert([
            'tipo' => 'Ofertante',
            'contenido' => 'Muy buen trato todo salio a lo acordado, lo recomiendo',
            'perfil_id' => 2,
            'user_id' => 3
        ]);


        DB::table('resenas')->insert([
            'tipo' => 'Trabajador',
            'contenido' => 'Muy buen trato todo salio a lo acordado, lo recomiendo',
            'perfil_id' => 2,
            'user_id' => 1
        ]);


        DB::table('resenas')->insert([
            'tipo' => 'Ofertante',
            'contenido' => 'Muy buen trato todo salio a lo acordado, lo recomiendo',
            'perfil_id' => 3,
            'user_id' => 2
        ]);

        DB::table('resenas')->insert([
            'tipo' => 'Ofertante',
            'contenido' => 'Muy buen trato todo salio a lo acordado, lo recomiendo',
            'perfil_id' => 3,
            'user_id' => 1
        ]);
    }
}
