<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Notifications\PushNotification;
use App\Repositories\CampanhaRepository;


use Auth;
use Notification;
use App\Models\PessoaPush;
use App\Notifications\PushNotificationExpo;

class SubscriptionAPIController extends AppBaseController
{
    /** @var  CampanhaRepository */    
    private $campanhaRepository;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CampanhaRepository $campanhaRepo)
    {
        //$this->middleware('auth');
        $this->campanhaRepository = $campanhaRepo;
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

        $usuarioPush = Auth('api')->user();
        
        $user = PessoaPush::firstOrCreate(
            [
            'endpoint' => $endpoint,
            'pessoa_id' => $usuarioPush->id
            ]
        );

        $user->updatePushSubscription($endpoint, $key, $token);        
        
        return response()->json(['success' => true], 200);
    }

    /**
     * Send Push Notifications to all users.
     * 
     * @return \Illuminate\Http\Response
     */
    public function push($idCampanha)
    {
        //AQUI FAREMOS A SELEÇÃO DE QUAIS PESSOAS RECEBERÃO
        //A NOTIFICAÇÃO, DE ACORDO COM O SEU SEGMENTO
        $campanha = $this->campanhaRepository->find($idCampanha);
        $pessoas = $campanha->pessoasQuery->get();
        $pessoasIds = $pessoas->pluck('id');
        $pessoasPush = PessoaPush::whereIn('pessoa_id', $pessoasIds)->get();        
        
        //WebPush
        Notification::send($pessoasPush, new PushNotification($campanha));
        // //Expo
        // Notification::send($pessoas, new PushNotificationExpo($campanha));

        
        // 'curl -H "Content-Type: application/json" -X POST "https://exp.host/--/api/v2/push/send" -d '{
        //     "to": ["ExponentPushToken[6R_fzjHyr5hX3cwSu0oSGA]", "ExponentPushToken[nracypPb4xzBWXPTTgJcbo]"],
        //     "title":"hello",
        //     "body": "world"
        //   }'';        
        
        foreach ($pessoasIds as $pessoaId) {
            $inSQL[] = 'App.Models.Pessoa.'.$pessoaId;
    
            $expoTokens = \DB::table('exponent_push_notification_interests')
            ->whereIn('key', $inSQL)->get()->pluck('value');
        }

        foreach ($expoTokens as $expoToken) {
            $data = array(
                "to" => $expoToken,
                "title" => $campanha->titulo,
                "body" => $campanha->texto
            );
    
            $payload = json_encode($data);
    
            $ch = curl_init('https://exp.host/--/api/v2/push/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            // Set HTTP Header for POST request 
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
            );
            
            // Submit the POST request
            $result = curl_exec($ch);
            
            // Close cURL session handle
            curl_close($ch);
    
            \Log::debug(json_encode($result));

        }  

        return redirect()->back(); 
    }
    
}
