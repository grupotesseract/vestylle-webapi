<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;


class PessoaPush extends Model
{
    use Notifiable,
        HasPushSubscriptions;

    protected $fillable = [
        'endpoint',
        'pessoa_id'
    ];

    protected $table = 'pessoas_push';
    /**
     * Determine if the given subscription belongs to this user.
     *
     * @param  \NotificationChannels\WebPush\PushSubscription $subscription
     * @return bool
     */
    public function pushSubscriptionBelongsToUser($subscription)
    {
        return (int) $subscription->pessoa_push_id === (int) $this->id;
    }
}
