<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;        
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
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)             
            ->from('megajau@vestylle.com.br', 'Vestylle')
            ->greeting('Olá!')
            ->salutation('Obrigado, ')
            ->subject(Lang::getFromJson('Solicitação de Recuperação de Senha'))
            ->line(Lang::getFromJson('Você está recebendo este e-mail pois houve uma solicitação de redefinição de senha para a sua conta'))
            ->action(Lang::getFromJson('Redefinir Senha'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(Lang::getFromJson('O link expirará em :count minutos.', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::getFromJson('Se você não solicitou essa ação, este e-mail pode ser ignorado.'));
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

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
