<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resena;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Resena::class, function (Faker $faker) {
    return [
        'tipo' => $faker->randomElement(['ofertante', 'trabajador']),
        'rate' => rand(0,5),
        'contenido' => $faker->paragraph,
        'tarea_id' => rand(1,100),
        'calificado' => rand(1,11),
        'calificador' => rand(1,11),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
