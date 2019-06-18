<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Notifications\PushNotification;
use App\Repositories\CampanhaRepository;


use Auth;
use Notification;
use App\Models\PessoaPush;

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
        $pessoasIds = $campanha->pessoasQuery->get()->pluck('id');
        $pessoasPush = PessoaPush::whereIn('pessoa_id', $pessoasIds)->get();
        Notification::send($pessoasPush, new PushNotification($campanha));
        return redirect()->back(); 
    }
    
}
