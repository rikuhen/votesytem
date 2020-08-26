<?php

use App\Models\Dignity;
use Illuminate\Database\Seeder;

class DignityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Dignity::class,5)->create();
    }
}
