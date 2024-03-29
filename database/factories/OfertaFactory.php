<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Tarea;
use App\Oferta;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Oferta::class, function (Faker $faker) {
    return [
        'tarea_id' => Tarea::inRandomOrder()->value('id') ?: factory(Tarea::class),
        'user_id' => User::inRandomOrder()->value('id') ?: factory(User::class),
        'contenido' => $faker->paragraph,
        'presupuesto' => rand(100, 100000),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
