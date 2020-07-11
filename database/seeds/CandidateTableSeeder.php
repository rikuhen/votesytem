<?php

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::create([
            'name' => 'Voto Blanco',
            'description' => 'Voto Blanco',
            'enabled' => 1,
            'type' => 'nulled',
        ]);

        Candidate::create([
            'name' => 'Voto Nulo',
            'description' => 'Voto Nulo',
            'enabled' => 1,
            'type' => 'nulled',
        ]);

        factory(Candidate::class,2)->create();
    }
}
