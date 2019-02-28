<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class NotificacaoTeste extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->title('Approved!')
            ->icon('/approved-icon.png')
            ->body('Your account was approved!')
            ->action('View account', 'view_account');
            // ->data(['id' => $notification->id])
            // ->badge()
            // ->dir()
            // ->image()
            // ->lang()
            // ->renotify()
            // ->requireInteraction()
            // ->tag()
            // ->vibrate()
    }
}

class SubscriptionController extends \App\Http\Controllers\AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Código de teste para envio de webpush
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dodo = \App\Models\User::latest()->first();
        $dodo->notify(new NotificacaoTeste);
        return $this->sendResponse(['teste'=>'sdfsdf'], "sucesso");
    }

    // Código de exemplo de como é feito o update dos dados do usuário
    public function updateSubscription()
    {
        $user = \App\Models\User::latest()->first();
        $user->updatePushSubscription("https://fcm.googleapis.com/fcm/send/dV1KYMArZVs:APA91bH2PzJO7TGsVe-KXBBYuGQlnyJUP6kEd7YIh-pRt14VPN1rAvFcLXd3JbCnDumOYp9a5RcXDdfGR5U2-gdy4dhEROut10ou-EcV26Id0ySQXINaBhY4bWEOrfiqiiVxylQX-KUL", "BFH2CaMpqkiO53g6fbvVqhVLAZA6XkRjgj_NxhRqxztoBs5v-DEPyjgWZlzucfodJyIgK4roASYKvX1sEeca3P4", "z1dVgfIekj2s4kUV5FWYsw");
    }
}
