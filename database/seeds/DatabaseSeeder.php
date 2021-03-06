<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call(UsuarioSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(TareaSeeder::class);
        $this->call(PreguntaSeeder::class);
        $this->call(OfertaSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(ResenalSeeder::class);
        $this->call(RespuestaPreguntaSeeder::class);
        $this->call(RespuestaOfertaSeeder::class);
        $this->call(DatosBancariosSeeder::class);
    }
}
