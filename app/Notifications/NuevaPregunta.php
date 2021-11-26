<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaPregunta extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tarea, $pregunta)
    {
        $this->tarea = $tarea;
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
            ->line('Has recivido una nueva pregunta.')
            ->line('La tarea es: ' . $this->tarea->nombre . '.')
            ->action('Visita YoNecesito', url('/tarea/mistareas?tarea_id=' . $this->tarea->id))
            ->line('Gracias por usar YoNecesito.');
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
            'tarea_id' => $this->tarea->id,
            'tarea_nombre' => $this->tarea->nombre,
            'pregunta_id' => $this->pregunta->id,
            'pregunta_autor' => $this->pregunta->autor->name,
            'pregunta_autor_id' => $this->pregunta->autor->id,
            'pregunta_autor_foto' => $this->pregunta->autor->perfil->imagen,
            'pregunta_contenido' => $this->pregunta->contenido,
            'pregunta_imagen' => $this->pregunta->imagen
        ];
    }
}
