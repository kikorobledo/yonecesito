<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaOferta extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tarea, $oferta)
    {
        $this->tarea = $tarea;
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
            ->line('Has recivido una nueva oferta.')
            ->line('La tarea es: ' . $this->tarea->nombre . '.')
            ->action('Visita YoNecesito', url('/tarea/mistareas?tarea_id=' . $this->tarea->id))
            ->line('Gracias por usar YoNecesito.');
    }

    /* Notificaciones en la base de datos */
    public function toDatabase($notifiable){

        return [
            'tarea_id' => $this->tarea->id,
            'tarea_nombre' => $this->tarea->nombre,
            'oferta_id' => $this->oferta->id,
            'oferta_autor' => $this->oferta->autor->name,
            'oferta_autor_id' => $this->oferta->autor->id,
            'oferta_autor_foto' => $this->oferta->autor->perfil->imagen,
            'oferta_contenido' => $this->oferta->contenido,
            'oferta_presupuesto' => $this->oferta->presupuesto,
            'oferta_imagen' => $this->oferta->image
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
