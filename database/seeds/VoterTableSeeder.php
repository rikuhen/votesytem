<?php

use Illuminate\Database\Seeder;
use App\Models\Voter;

class VoterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Voter::class,30)->create();
    }
}
