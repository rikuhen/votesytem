<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SetPasswordForVoters extends Notification implements ShouldQueue
{
    use Queueable;

    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $companyName = config('app.name');
        $dateEvent =  config('votes.app-available-from-date'); 
        $startHour = config('votes.app-available-from-hour');
        $endHour = config('votes.app-available-until-hour');

        return (new MailMessage)
            ->subject("{$companyName} - Notificación de Usuario")
            ->line("Estimado(a) {$notifiable->name}, notificamos sus credenciales de acceso para ejercer su derecho al voto en elección de representantes del {$companyName}")
            ->line("Usuario: {$notifiable->identification}")
            ->line("Contraseña:  {$this->password}")
            ->line("El sistema estará disponible el {$dateEvent} desde las {$startHour} hasta las {$endHour} del mismo día")
            ->line("Puede ejercer su voto presionando sobre el botón Votar")
            ->action('Votar', url('/'))
            ->line('Esto es una notificación automática, favor no contestar este mensaje');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => $notifiable->name,
            'email' => $notifiable->email,
            'description' => 'Se procedio a notificar su usuario'
        ];
    }
}
