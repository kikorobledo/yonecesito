<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfils')->insert([
            'imagen' => 'asdlkjabksda.jpg',
            'titulo' => 'Carpintero',
            'acerca_de_mi' => 'Soy carpintero desde siempre porque asi me gustas y que tiene?!',
            'cv' => 'askjdaksd.pdf',
            'educacion' => 'Universidad',
            'idiomas' => 'Ingles',
            'trabajo' => 'Carpintero',
            'direccion' => 'Calle vainilla #34',
            'colonia' => 'Fresnos',
            'especialidad' => 'Madera fina',
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'imagen' => 'asdlkjabksda.jpg',
            'titulo' => 'Medico',
            'acerca_de_mi' => 'Medico internista trabajando en el hospital de la mujer',
            'cv' => 'askjdaksd.pdf',
            'educacion' => 'Doctorado',
            'idiomas' => 'Ingles,Frances,Italiano',
            'trabajo' => 'Medico',
            'direccion' => 'Calle girasoles #34',
            'colonia' => 'Porvenir',
            'especialidad' => 'Cardiología',
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'imagen' => 'asdlkjabksda.jpg',
            'titulo' => 'Ingeniero Civil',
            'acerca_de_mi' => 'Ingeniero con experiencia en construccion de vialidades',
            'cv' => 'askjdaksd.pdf',
            'educacion' => 'Universidad',
            'idiomas' => 'Ingles',
            'trabajo' => 'Ingeniero Civil',
            'direccion' => 'Calle Madero #34',
            'colonia' => 'Centro',
            'especialidad' => 'Carreteras',
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
