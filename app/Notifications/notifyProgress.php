<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class notifyProgress extends Notification
{
    use Queueable;

    private $name;
    private $laporan;
    private $progress;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$laporan,$progress)
    {
        $this->name = $name;
        $this->laporan = $laporan;
        $this->progress = $progress;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
          ->subject('Progress Laporan '.$this->laporan)
          ->greeting('Dear '.$this->name.', ')
          ->line('Terdapat tanggapan baru pada laporan anda')
          ->line('"'.$this->progress.'"')
          ->line('Jika anda merasa bahwa tanggapan tersebut bagus silakan apresiasi tanggapan tersebut dengan memberi vote positif.')
          ->line('Terimakasih')
          ->salutation('LAJANG');

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
