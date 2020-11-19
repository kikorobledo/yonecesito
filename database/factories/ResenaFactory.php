<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resena;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Resena::class, function (Faker $faker) {
    return [
        'tipo' => $faker->randomElement(['Trabajador', 'Ofertante']),
        'contenido' => $faker->paragraph,
        'receptor' => rand(1,11),
        'autor' => rand(1,11),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
