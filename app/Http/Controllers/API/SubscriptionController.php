<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Notifications\PushNotification;

use Auth;
use Notification;
use App\Models\Guest;

class SubscriptionController extends AppBaseController
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
     * Store the PushSubscription.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, 
            [
                'endpoint'    => 'required',
                'keys.auth'   => 'required',
                'keys.p256dh' => 'required'
            ]
        );
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        
        $user = Guest::firstOrCreate([
            'endpoint' => $endpoint
        ]);

        $user->updatePushSubscription($endpoint, $key, $token);        
        
        return response()->json(['success' => true], 200);
    }

    /**
     * Send Push Notifications to all users.
     * 
     * @return \Illuminate\Http\Response
     */
    public function push()
    {
        Notification::send(Guest::all(), new PushNotification);
        return redirect()->back();
    }
    
}
