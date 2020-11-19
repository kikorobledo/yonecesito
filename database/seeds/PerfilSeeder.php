<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfils')->insert([
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        DB::table('perfils')->insert([
            'user_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        DB::table('perfils')->insert([
            'user_id' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('perfils')->insert([
            'user_id' => 11,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
