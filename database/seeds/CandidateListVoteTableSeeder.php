<?php

use App\Models\ListVote;
use App\Models\CandidateListVote;
use Illuminate\Database\Seeder;

class CandidateListVoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = ListVote::whereName('Lista 1')->first();
        
        if ($list) {
            CandidateListVote::create(
                [
                    'list_id' => $list->id,
                    'name' => 'Jhon Doe',
                    'position' => 'President'
                ]
            );
        }
    }
}
