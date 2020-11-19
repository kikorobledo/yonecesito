<?php

use App\User;
use Carbon\Carbon;
use Faker\Factory;
use App\DatoBancario;
use Illuminate\Database\Seeder;

class DatosBancariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i = 1; $i <= User::all()->count(); $i++){
            DatoBancario::create([
                'user_id' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
