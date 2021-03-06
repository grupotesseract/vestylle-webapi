<?php

namespace App\Http\Controllers;

use App\Jobs\SincronizarComCloudinary;
use App\Http\Requests;
use App\Http\Requests\UpdateLojaRequest;
use App\Repositories\LojaRepository;
use App\Repositories\FotoRepository;
use App\Models\Loja;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;

class LojaController extends AppBaseController
{
    /** @var  LojaRepository */
    private $lojaRepository;
    private $fotoRepository;

    public function __construct(LojaRepository $lojaRepo, FotoRepository $fotoRepo)
    {
        $this->lojaRepository = $lojaRepo;
        $this->fotoRepository = $fotoRepo;
    }

    /**
     * Display the specified Loja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loja = $this->lojaRepository->findWithoutFail($id);

        if (empty($loja)) {
            Flash::error('Loja not found');

            return redirect(route('lojas.index'));
        }

        return view('lojas.show')->with('loja', $loja);
    }

    /**
     * Show the form for editing the specified Loja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loja = $this->lojaRepository->findWithoutFail($id);

        if (empty($loja)) {
            Flash::error('Loja not found');

            return redirect(route('lojas.index'));
        }

        return view('lojas.edit')->with('loja', $loja);
    }

    /**
     * Update the specified Loja in storage.
     *
     * @param  int              $id
     * @param UpdateLojaRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();
        $loja = $this->lojaRepository->findWithoutFail($id);

        $validated = $request->validate(Loja::$rules);

        if (empty($loja)) {
            Flash::error('Loja not found');

            return redirect(route('lojas.index'));
        }

        $fotos = $request->allFiles()['files'] ?? false;
        $hasFotos = !empty($fotos);
        $canUpload = $hasFotos ? \App\Helpers\Helpers::checkUploadLimit($loja, count($fotos)) : true;

        if ($canUpload == false) {
            $loja = $this->lojaRepository->update($input, $id);
            Flash::error('Número máximo de imagens atingido. Tente novamente');
            Flash::success('Loja atualizada com sucesso.');
            return redirect(route('lojas.edit', $loja));
        }

        if ($hasFotos) {
            $fotos = $this->fotoRepository->uploadAndCreate($request);
            $loja->fotos()->saveMany($fotos);

            foreach ($fotos as $foto) {
                $this->dispatch(new SincronizarComCloudinary($foto));
            }
        }

        $loja = $this->lojaRepository->update($input, $id);

        Flash::success('Loja atualizada com sucesso.');

        return redirect(route('lojas.show', $loja));
    }

}
