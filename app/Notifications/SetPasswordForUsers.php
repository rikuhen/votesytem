<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SetPasswordForUsers extends Notification
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
        return ['mail','database'];
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
        return (new MailMessage)
                    ->subject("{$companyName} - Notificación de Veedor")
                    ->line("Estimado(a) {$notifiable->name}, notificamos sus credenciales de acceso como veedor de {$companyName}")
                    ->line("Usuario: {$notifiable->username}")
                    ->line("Contraseña:  {$this->password}")
                    ->line("Puede ingresar presionando sobre el botón Ingresar")
                    ->action('Ingresar', url('/voteadmin'))
                    ->line('Gracias!');
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
