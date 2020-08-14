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
            'lat' => '213545640236',
            'lng' => '684645315315',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'uuid' => 'asldubla',
            'presupuesto' => 12312425,
            'estado' => 'activo',
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tareas')->insert([
            'nombre' => 'Pintar casa',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'lat' => '213545640236',
            'lng' => '684645315315',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'uuid' => 'asldubla',
            'presupuesto' => 12312425,
            'estado' => 'asignado',
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tareas')->insert([
            'nombre' => 'Arreglar motor',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'lat' => '213545640236',
            'lng' => '684645315315',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'uuid' => 'asldubla',
            'presupuesto' => 12312425,
            'estado' => 'concluido',
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tareas')->insert([
            'nombre' => 'Pasear perros',
            'direccion' => 'Avenida falsa #123',
            'colonia' => 'Centro',
            'lat' => '213545640236',
            'lng' => '684645315315',
            'descripcion' => 'Se Ofrecen clases de manejo para principiantes',
            'fecha_de_vencimiento' => Carbon::now(),
            'uuid' => 'asldubla',
            'presupuesto' => 12312425,
            'estado' => 'expirado',
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
