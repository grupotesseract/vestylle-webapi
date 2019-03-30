<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\OfertaDataTable;
use App\DataTables\PessoaDataTable;
use App\Repositories\FotoRepository;
use App\Repositories\OfertaRepository;
use App\Http\Requests\CreateOfertaRequest;
use App\Http\Requests\UpdateOfertaRequest;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Scopes\PessoasPorOferta;

class OfertaController extends AppBaseController
{
    /** @var  OfertaRepository */
    private $ofertaRepository;
    private $fotoRepository;

    public function __construct(OfertaRepository $ofertaRepo, FotoRepository $fotoRepo)
    {
        $this->ofertaRepository = $ofertaRepo;
        $this->fotoRepository = $fotoRepo;
    }

    /**
     * Display a listing of the Oferta.
     *
     * @param OfertaDataTable $ofertaDataTable
     * @return Response
     */
    public function index(OfertaDataTable $ofertaDataTable)
    {
        return $ofertaDataTable->render('ofertas.index');
    }

    /**
     * Show the form for creating a new Oferta.
     *
     * @return Response
     */
    public function create()
    {
        return view('ofertas.create');
    }

    /**
     * Store a newly created Oferta in storage.
     *
     * @param CreateOfertaRequest $request
     *
     * @return Response
     */
    public function store(CreateOfertaRequest $request)
    {
        $input = $request->all();

        $oferta = $this->ofertaRepository->create($input);

        $hasFoto = $request->hasFile('foto');
        if ($hasFoto) {
            if ($oferta->foto) {
                $oferta->foto->delete();
            }

            $foto = $this->fotoRepository->uploadAndCreate($request);
            $oferta->foto()->save($foto);

            //Upload p/ Cloudinary e delete local
            $publicId = "oferta_".time();
            $this->fotoRepository->sendToCloudinary($foto, $publicId, env('CLOUDINARY_CLOUD_FOLDER'));
            $this->fotoRepository->deleteLocal($foto->id);
        }

        Flash::success('Oferta criada com sucesso.');

        return redirect(route('ofertas.index'));
    }

    /**
     * Display the specified Oferta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(PessoaDataTable $pessoaDataTable, $id)
    {
        $oferta = $this->ofertaRepository->findWithoutFail($id);

        if (empty($oferta)) {
            Flash::error('Oferta não encontrada');
            return redirect(route('ofertas.index'));
        }

        return $pessoaDataTable->addScope(new PessoasPorOferta($id))
            ->render('ofertas.show', compact('oferta'));
    }

    /**
     * Show the form for editing the specified Oferta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $oferta = $this->ofertaRepository->findWithoutFail($id);

        if (empty($oferta)) {
            Flash::error('Oferta não encontrada');

            return redirect(route('ofertas.index'));
        }

        return view('ofertas.edit')->with('oferta', $oferta);
    }

    /**
     * Update the specified Oferta in storage.
     *
     * @param  int              $id
     * @param UpdateOfertaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfertaRequest $request)
    {
        $input = $request->all();
        $oferta = $this->ofertaRepository->findWithoutFail($id);

        if (empty($oferta)) {
            Flash::error('Oferta não encontrada');

            return redirect(route('ofertas.index'));
        }

        $hasFoto = $request->foto;
        if ($hasFoto) {
            if ($oferta->foto) {
                $oferta->foto->delete();
            }

            $foto = $this->fotoRepository->uploadAndCreate($request);
            $oferta->foto()->save($foto);

            //Upload p/ Cloudinary e delete local
            $publicId = "oferta_".time();
            $this->fotoRepository->sendToCloudinary($foto, $publicId, env('CLOUDINARY_CLOUD_FOLDER'));
            $this->fotoRepository->deleteLocal($foto->id);
        }

        $oferta = $this->ofertaRepository->update($input, $id);

        Flash::success('Oferta atualizada com sucesso.');

        return redirect(route('ofertas.edit', $oferta));
    }

    /**
     * Remove the specified Oferta from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $oferta = $this->ofertaRepository->findWithoutFail($id);

        if (empty($oferta)) {
            Flash::error('Oferta não encontrada');

            return redirect(route('ofertas.index'));
        }

        $this->ofertaRepository->delete($id);

        Flash::success('Oferta excluída com sucesso.');

        return redirect(route('ofertas.index'));
    }

}
