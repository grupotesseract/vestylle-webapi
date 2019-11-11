<?php

namespace App\Http\Controllers\API;

use Notification;
use App\Models\PessoaPush;
use Illuminate\Http\Request;
use App\Notifications\PushNotification;
use App\Repositories\CampanhaRepository;
use App\Http\Controllers\AppBaseController;
use App\Jobs\SendExpoPushes;

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

        $usuarioPush = \Auth('api')->user();

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
        $campanha = $this->campanhaRepository->find($idCampanha);
        $pessoas = $campanha->pessoasQuery->get();

        //Se nao existirem pessoas elegiveis para receber a push, retornar erro.
        if (!$pessoas->count()) {
            \Flash::error('Não existem pessoas elegiveis para receber a notificação. Modifique a segmentação da campanha');
            return redirect()->back();
        }

        $pessoasIds = $pessoas->pluck('id');
        $pessoasPush = PessoaPush::whereIn('pessoa_id', $pessoasIds)->get();

        //WebPush
        Notification::send($pessoasPush, new PushNotification($campanha));

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

            SendExpoPushes::dispatch($data);
        }

        return redirect()->back();
    }

}
