<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


class SendPasswordUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-passwords-users {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia claves a los veedores';

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
        $email = $this->argument('email');

        if (!$email) {
            //Envia a todos los usuarios quienes no se haya notificado
            $users = User::where('role', 'supervisor')
                ->whereEnabled(1)
                // ->whereObservation('no-notificated')
                //->take(3)
                ->get();

            foreach ($users as $key => $user) {
                $user->sendPassword();
            }
        } else {
            //Busca un usuario por su correo y envia la notificacion sin importar que haya o no recibido la notificacion

            $user = User::where('role', 'supervisor')
                ->whereEnabled(1)
                ->whereEmail($email)
                ->first();

            if ($user) {
                $user->sendPassword();
            } else {
                $this->info("No se puede enviar la contraseña a este usuario probablemente ya haya votado");
            }
        }
    }
}
