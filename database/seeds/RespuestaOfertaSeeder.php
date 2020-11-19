<?php

use App\RespuestaOferta;
use Illuminate\Database\Seeder;

class RespuestaOfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RespuestaOferta::class, 70)->create();
    }
}
