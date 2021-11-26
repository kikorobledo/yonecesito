<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaAsignacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tarea)
    {
        $this->tarea = $tarea;
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
        return (new MailMessage)
                    ->line('Se te ha asignado una tarea.')
                    ->line('La tarea es: ' . $this->tarea->nombre . '.')
                    ->action('Visita YoNecesito', url('/notificaciones_asignaciones'))
                    ->line('Gracias por usar YoNecesito.');
    }

    /* Notificaciones en la base de datos */
    public function toDatabase($notifiable){

        return [
            'tarea_id' => $this->tarea->id,
            'tarea_nombre' => $this->tarea->nombre,
            'tarea_contenido' => $this->tarea->descripcion,
            'tarea_autor_id' => $this->tarea->usuario->id,
            'tarea_autor_nombre' => $this->tarea->usuario->name,
        ];
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
}
