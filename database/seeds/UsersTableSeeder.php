<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');
        //Admin
        User::create([
            'num_identification' => '0926894544',
            'name' => 'Jorge Veliz Admin',
            'username' => 'admin',
            'role' => 'admin',
            'enabled' => 1,
            'email' => 'info@thejlmedia.com',
            'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //supervisor Ministerio
        User::create([
            'num_identification' => '9999999910',
            'name' => 'Veedor Ministerio',
            'username' => 'veedor_min',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'veedor_min@mail.com',
            'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //supervisor CNE
        User::create([
            'num_identification' => '9999999911',
            'name' => 'Veedor CNE',
            'username' => 'veedor_cne',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'veedor_cne@mail.com',
            'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);
    }
}
