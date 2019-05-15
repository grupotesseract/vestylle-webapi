<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CuponRepository;
use Flash;

class QRCodeController extends Controller
{
    private $cuponRepository;

    /**
     * @param CuponRepository $cuponRepository
     */
    public function __construct(CuponRepository $cuponRepository)
    {
        $this->cuponRepository = $cuponRepository;
    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function getQrcode(Request $request)
    {
        $cupon = $this->cuponRepository->findWithoutFail($request->id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('cupons.index'));
        }


        //TODO
        //1- Criar metodo para encryptar e decryptar o id do cupom
        //2- Incluir botão 'Ver QrCode no show do cupom'
        //3- ??
        //$hash = $cupon->getHash();

        return view('cupons.partials.qrcode')->with('hash', 'lalala');
    }



}
