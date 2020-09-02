<?php

use App\Models\User;
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

        $fileVoters = storage_path('app/public/voters.csv');

        if (file_exists($fileVoters)) {
            $fileHandler = fopen($fileVoters, 'r');

            while (!feof($fileHandler)) {
                $line = fgetcsv($fileHandler, 0, ',');
                if ($line) {
                    User::create(
                        [
                            'identification' => $line[0],
                            'name' => ltrim($line[1]),
                            'email' => $line[2],
                            // 'password' => Hash::make('password'), // password
                            'role' => 'voter',
                            'enabled' => 1,
                            'observation' => 'no-notificated'
                        ]

                    );
                }
            }
            fclose($fileHandler);
        } else {
            Voter::create([
                'identification' => '0926894544',
                'name' => 'Jorge Luis Veliz Berzosa',
                'email' => 'jorgeconsalvacion@gmail.com',
                // 'password' => Hash::make('password'), // password
                'role' => 'voter',
                'enabled' => 1,
                'observation' => 'no-notificated'
            ]);

            Voter::create([
                'identification' => '0952214468',
                'name' => 'Karen Mariuxi Pachedo Delgado',
                'email' => 'karen-pd@hotmail.com',
                // 'password' => Hash::make('password'), // password
                'role' => 'voter',
                'enabled' => 1,
                'observation' => 'no-notificated'
            ]);

            // factory(Voter::class,30)->create();



        }
    }
}
