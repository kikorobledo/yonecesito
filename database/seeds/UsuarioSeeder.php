<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Enrique',
            'email' => 'correo1@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Jesus',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Miguel',
            'email' => 'correo3@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Andrey',
            'email' => 'correo4@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Felipe',
            'email' => 'correo5@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Maria',
            'email' => 'correo6@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Alejandra',
            'email' => 'correo7@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Carolina',
            'email' => 'correo8@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        DB::table('users')->insert([
            'name' => 'Angel',
            'email' => 'correo9@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Christian',
            'email' => 'correo10@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        DB::table('users')->insert([
            'name' => 'Nancy',
            'email' => 'correo11@correo.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
