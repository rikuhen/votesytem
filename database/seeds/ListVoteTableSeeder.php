<?php

use App\Models\ListVote;
use Illuminate\Database\Seeder;

class ListVoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListVote::create([
            'name' => 'Lista 1',
            'description' => 'Lista 1',
            'enabled' => 1,
        ]);
    }
}
