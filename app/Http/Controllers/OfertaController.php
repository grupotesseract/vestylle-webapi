<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\Models\Oferta;
use Illuminate\Http\Request;
use App\DataTables\OfertaDataTable;
use App\DataTables\PessoaDataTable;
use App\Repositories\FotoRepository;
use App\Jobs\SincronizarComCloudinary;
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
    public function store(Request $request)
    {
        $input = $request->all();

        $validated = $request->validate(Oferta::$rules);

        $oferta = $this->ofertaRepository->create($input);

        $fotos = $request->allFiles()['files'] ?? false;
        $hasFotos = !empty($fotos);

        if ($hasFotos) {
            $fotos = $this->fotoRepository->uploadAndCreate($request);
            $oferta->fotos()->saveMany($fotos);

            foreach ($fotos as $foto) {
                $this->dispatch(new SincronizarComCloudinary($foto));
            }
        }

        //pegando categorias da request, se nao tiver,
        //usar array vazio para remover categorias
        $categorias = $request->categorias ?? [];
        $oferta->categorias()->sync($categorias);

        Flash::success('Oferta criada com sucesso.');

        return redirect(route('ofertas.show', $oferta));
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
    public function update($id, Request $request)
    {
        $input = $request->all();
        $oferta = $this->ofertaRepository->findWithoutFail($id);

        if (empty($oferta)) {
            Flash::error('Oferta não encontrada');

            return redirect(route('ofertas.index'));
        }

        $validated = $request->validate(Oferta::$rules);

        $fotos = $request->allFiles()['files'] ?? false;
        $hasFotos = !empty($fotos);
        $canUpload = $hasFotos ? \App\Helpers\Helpers::checkUploadLimit($oferta, count($fotos)) : true;

        if ($canUpload == false) {
            $oferta = $this->ofertaRepository->update($input, $id);
            Flash::error('Número máximo de imagens atingido. Tente novamente');
            Flash::success('Oferta atualizada com sucesso.');
            return redirect(route('ofertas.edit', $oferta));
        }

        if ($hasFotos) {
            $fotos = $this->fotoRepository->uploadAndCreate($request);
            $oferta->fotos()->saveMany($fotos);

            foreach ($fotos as $foto) {
                $this->dispatch(new SincronizarComCloudinary($foto));
            }
        }

        $oferta = $this->ofertaRepository->update($input, $id);

        //pegando categorias da request, se nao tiver,
        //usar array vazio para remover categorias
        $categorias = $request->categorias ?? [];
        $oferta->categorias()->sync($categorias);

        Flash::success('Oferta atualizada com sucesso.');

        return redirect(route('ofertas.show', $oferta));
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
