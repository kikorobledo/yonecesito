<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Pregunta;
use Carbon\Carbon;
use App\RespuestaPregunta;
use Faker\Generator as Faker;

$factory->define(RespuestaPregunta::class, function (Faker $faker) {
    return [
        'pregunta_id' => Pregunta::inRandomOrder()->value('id') ?: factory(Pregunta::class),
        'user_id' => User::inRandomOrder()->value('id') ?: factory(User::class),
        'contenido' => $faker->paragraph,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
