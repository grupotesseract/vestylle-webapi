<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

use App\Models\Campanha;

class PushNotification extends Notification
{
    use Queueable;

    private $campanha;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Campanha $campanha)
    {
        $this->campanha = $campanha;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }    

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->campanha->titulo)
            ->icon('/furacao.png')
            ->body($this->campanha->texto)
            ->action('Acessar', $this->campanha->url);
    }
}
