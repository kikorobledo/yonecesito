<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Oferta;
use Carbon\Carbon;
use App\RespuestaOferta;
use Faker\Generator as Faker;

$factory->define(RespuestaOferta::class, function (Faker $faker) {
    return [
        'oferta_id' => Oferta::inRandomOrder()->value('id') ?: factory(Oferta::class),
        'user_id' => User::inRandomOrder()->value('id') ?: factory(User::class),
        'contenido' => $faker->paragraph,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
