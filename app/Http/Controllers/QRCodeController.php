<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use App\Repositories\CuponRepository;

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
     * Metodo para servir uma view com o QRCode de um Cupon.
     *
     * @param Request $request
     */
    public function getQrcode(Request $request)
    {
        $cupon = $this->cuponRepository->findWithoutFail($request->id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('cupons.index'));
        }

        //$valorQRCode = env('URL_FRONT_CUPON').$cupon->IdEncryptado;
        $cupon->qrcode = md5($cupon->id);
        $cupon->save();
        $valorQRCode = env('URL_FRONT_CUPON').md5($cupon->qrcode);
        
        $filePath = "uploads/$cupon->titulo.png";
        $qrcode = \QrCode::format('png')->size(500)->generate($valorQRCode, $filePath);

        return \Response::download($filePath);
    }



}
