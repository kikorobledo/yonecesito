<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaRespuestaOferta extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($respuesta_oferta, $oferta)
    {
        $this->respuesta_oferta = $respuesta_oferta;
        $this->oferta = $oferta;
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
            ->line('Has recivido una respusta a tu oferta.')
            ->line('La tarea es: ' . $this->oferta->tarea->nombre . '.')
            ->action('Visita YoNecesito', url('/tareas?tarea_id=' . $this->oferta->tarea->id))
            ->line('Gracias por usar YoNecesito.');
    }

    /* Notificaciones en la base de datos */
    public function toDatabase($notifiable){

        return [
            'tarea_id' => $this->oferta->tarea->id,
            'tarea_nombre' => $this->oferta->tarea->nombre,
            'oferta_id' => $this->oferta->id,
            'oferta_autor' => $this->oferta->autor->name,
            'oferta_autor_id' => $this->oferta->autor->id,
            'oferta_contenido' => $this->oferta->contenido,
            'respuesta_oferta_id' => $this->respuesta_oferta->id,
            'respuesta_oferta_contenido' => $this->respuesta_oferta->contenido,
            'respuesta_oferta_autor' => $this->respuesta_oferta->autor->name,
            'respuesta_oferta_autor_id' => $this->respuesta_oferta->autor->id,
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
