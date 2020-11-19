<?php

use App\RespuestaPregunta;
use Illuminate\Database\Seeder;

class RespuestaPreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RespuestaPregunta::class, 70)->create();
    }
}
