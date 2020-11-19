<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'nombre' => 'Aguascalientes',
            'lat' => '21.8798228',
            'lng' => '-102.2960467',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Baja California',
            'lat' => '32.6136808',
            'lng' => '-115.590376',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Baja California Sur',
            'lat' => '24.1164329',
            'lng' => '-110.3377464',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Campeche',
            'lat' => '19.8305682',
            'lng' => '-90.5798364',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Coahuila de Zaragoza',
            'lat' => '25.4303723',
            'lng' => '-101.0532634',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Colima',
            'lat' => '19.2400444',
            'lng' => '-103.7636271',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Chiapas',
            'lat' => '16.7459946',
            'lng' => '-93.1645893',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Chihuahua',
            'lat' => '28.6709132',
            'lng' => '-106.134658',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Ciudad de México',
            'lat' => '19.39068',
            'lng' => '-99.2836969',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Durango',
            'lat' => '24.0226943',
            'lng' => '-104.6827442',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Guanajuato',
            'lat' => '21.0251069',
            'lng' => '-101.2753897',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Guerrero',
            'lat' => '17.5477072',
            'lng' => '-99.5324348',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Hidalgo',
            'lat' => '20.0825159',
            'lng' => '-98.7917973',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Jalisco',
            'lat' => '20.6737883',
            'lng' => '-103.3704326',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'México',
            'lat' => '19.3255486',
            'lng' => '-100.1654225',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Michoacán de Ocampo',
            'lat' => '19.7036519',
            'lng' => '-101.2411434',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Morelos',
            'lat' => '18.9318783',
            'lng' => '-99.2755844',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Nayarit',
            'lat' => '21.5009822',
            'lng' => '-104.911924',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Nuevo León',
            'lat' => '25.6487281',
            'lng' => '-100.4431799',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Oaxaca',
            'lat' => '17.0812951',
            'lng' => '-96.770751',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Puebla',
            'lat' => '19.040034',
            'lng' => '-98.2630051',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Querétaro',
            'lat' => '20.6121334',
            'lng' => '-100.4452366',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Quintana Roo',
            'lat' => '18.5221591',
            'lng' => '-88.3222882',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'San Luis Potosí',
            'lat' => '22.1127046',
            'lng' => '-101.0261094',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Sinaloa',
            'lat' => '24.8049008',
            'lng' => '-107.493354',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Sonora',
            'lat' => '29.082137',
            'lng' => '-111.0590265',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Tabasco',
            'lat' => '17.9925264',
            'lng' => '-92.9881406',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Tamaulipas',
            'lat' => '23.7409928',
            'lng' => '-99.1783574',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Tlaxcala',
            'lat' => '19.4167799',
            'lng' => '-98.4471046',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Veracruz de Ignacio de la Llave',
            'lat' => '19.5420462',
            'lng' => '-96.9199274',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Yucatán',
            'lat' => '20.9800512',
            'lng' => '-89.7029582',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('estados')->insert([
            'nombre' => 'Zacatecas',
            'lat' => '23.0795959',
            'lng' => '-103.669099',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
