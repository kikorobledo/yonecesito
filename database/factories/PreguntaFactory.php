<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Tarea;
use App\Pregunta;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Pregunta::class, function (Faker $faker) {
    return [
        'tarea_id' => Tarea::inRandomOrder()->value('id') ?: factory(Tarea::class),
        'user_id' => User::inRandomOrder()->value('id') ?: factory(User::class),
        'contenido' => $faker->paragraph,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
