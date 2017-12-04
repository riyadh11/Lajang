<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class confirmationAccount extends Notification
{
    use Queueable;

    private $token;
    private $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        $this->token = $token;
        $this->name = $name;
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
          ->subject('Aktivasi Akun Lapor Jalan Ngalam')
          ->greeting('Dear '.$this->name.', ')
          ->line('Pendaftaran anda sudah berhasil, silakan aktivasi akun anda untuk mulai menggunakan sistem Lajang.')
          ->action('Aktivasi', url('/penduduk/confirmation', $this->token))
          ->line('Terimakasih sudah bergabung dengan sitem Lajang, semoga sistem ini membantu kehidupan anda.')
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
