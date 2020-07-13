<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SendPasswordVoters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-passwords-voters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia claves a los votantes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->arguments();
        if ( count($options) > 1 ) {
            return $this->error("this command don't accept arguments");
        }

        $users = User::where('role','voter')
                ->whereEnabled(1)
                ->whereObservation('no-notificated')
                ->take(5)
                ->get();

        foreach ($users as $key => $user) {
            $user->sendPassword();
        }
    }
}
