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
            'identification' => '000000000',
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
            'identification' => '9999999910',
            'name' => 'Veedor Ministerio',
            'username' => 'veedor_min',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'veedor_min@mail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //supervisor CNE
        User::create([
            'identification' => '0910987270',
            'name' => 'CARLOS  JIMENEZ BARCOS',
            'username' => 'veedor_cne',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'cjimenez10000@gmail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);


        //PRESIDENTA DEL CNE INTERNO
        User::create([
            'identification' => '0910987270',
            'name' => 'GARCIA YANCE DIANA PILAR',
            'username' => 'presidenta',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'dianagarciay65@hotmail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //SECRETARIO CNE INTERNO
        User::create([
            'identification' => '0910180587',
            'name' => 'DAVILA RAMIREZ GEORGE ORLANDO',
            'username' => 'secretario',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'davila.ramirez.george@hotmail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //VOCAL1
        User::create([
            'identification' => '0907424279',
            'name' => 'VACA MENDIETA JENNY LILIANA',
            'username' => 'vocaluno',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'jennyliliana1985@hotmail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //VOCAL2
        User::create([
            'identification' => '0915172597',
            'name' => 'SANCHEZ GOMEZ GEOVANNI FRANCISCO',
            'username' => 'vocaldos',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'geovannyotto@hotmail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);

        //REPRESENTANTE LISTA 1
        User::create([
            'identification' => '0913906764',
            'name' => 'MOSCOSO FLORENCIA JOSE REYNALDO',
            'username' => 'replistauno',
            'role' => 'supervisor',
            'enabled' => 1,
            'email' => 'jmoscoso_79@hotmail.com',
            // 'password' => $password, // password
            'remember_token' => Str::random(10),
        ]);
    }
}
