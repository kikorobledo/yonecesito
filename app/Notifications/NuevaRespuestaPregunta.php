<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaRespuestaPregunta extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($respuesta_pregunta, $pregunta)
    {
        $this->respuesta_pregunta = $respuesta_pregunta;
        $this->pregunta = $pregunta;
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
        return (new MailMessage)
                ->line('Has recivido una respusta a tu pregunta.')
                ->line('La tarea es: ' . $this->pregunta->tarea->nombre . '.')
                ->action('Visita YoNecesito', url('/tareas?tarea_id=' . $this->pregunta->tarea->id))
                ->line('Gracias por usar YoNecesito.');
    }

    /* Notificaciones en la base de datos */
    public function toDatabase($notifiable){

        return [
            'tarea_id' => $this->pregunta->tarea->id,
            'tarea_nombre' => $this->pregunta->tarea->nombre,
            'pregunta_id' => $this->pregunta->id,
            'pregunta_autor' => $this->pregunta->autor->name,
            'pregunta_autor_id' => $this->pregunta->autor->id,
            'pregunta_contenido' => $this->pregunta->contenido,
            'pregunta_imagen' => $this->respuesta_pregunta->imagen,
            'respuesta_pregunta_id' => $this->respuesta_pregunta->id,
            'respuesta_pregunta_contenido' => $this->respuesta_pregunta->contenido,
            'respuesta_pregunta_autor' => $this->respuesta_pregunta->autor->name,
            'respuesta_pregunta_autor_id' => $this->respuesta_pregunta->autor->id,
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
