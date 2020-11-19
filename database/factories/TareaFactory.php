<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tarea;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Tarea::class, function (Faker $faker) {
    $estado_id = rand(1,32);
    $estado = Estado::find($estado_id);
    return [
        'nombre' => $faker->name,
        'direccion' => $faker->address,
        'colonia' => $faker->name,
        'descripcion' => $faker->paragraph,
        'estado_id' => $estado_id,
        'lng' => $estado->lng,
        'lat' => $estado->lat,
        'presupuesto' => rand(100, 100000),
        'estatus' => $faker->randomElement(['activa', 'asignada', 'concluida', 'expirada']),
        'tipo' => $faker->randomElement(['presencial', 'remoto']),
        'fecha_de_vencimiento' => Carbon::now(),
        'created_at' => Carbon::now(),
        'user_id' => rand(1,11),
        'updated_at' => Carbon::now()
    ];
});
