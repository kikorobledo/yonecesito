<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tareas')->insert([
            'nombre' => 'Clases de manejo',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'estado_id' => 2,
            'lat' => '19.688615',
            'lng' => '-101.1982996,20',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'presupuesto' => 1300,
            'estatus' => 'activa',
            'tipo' => 'presencial',
            'user_id' => 1,
            'trabajador' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tareas')->insert([
            'nombre' => 'Pintar casa',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'estado_id' => 5,
            'lat' => '19.688615',
            'lng' => '-101.1982996,20',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'presupuesto' => 500,
            'estatus' => 'asignada',
            'tipo' => 'presencial',
            'user_id' => 1,
            'trabajador' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tareas')->insert([
            'nombre' => 'Arreglar motor',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'estado_id' => 8,
            'lat' => '19.688615',
            'lng' => '-101.1982996,20',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'presupuesto' => 1100,
            'estatus' => 'concluida',
            'tipo' => 'presencial',
            'user_id' => 2,
            'trabajador' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tareas')->insert([
            'nombre' => 'Pasear perros',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'estado_id' => 11,
            'lat' => '19.688615',
            'lng' => '-101.1982996,20',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'presupuesto' => 600,
            'estatus' => 'expirada',
            'tipo' => 'remoto',
            'user_id' => 3,
            'trabajador' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
