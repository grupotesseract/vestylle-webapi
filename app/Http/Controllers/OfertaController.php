<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\OfertaDataTable;
use App\DataTables\PessoaDataTable;
use App\Repositories\OfertaRepository;
use App\Http\Requests\CreateOfertaRequest;
use App\Http\Requests\UpdateOfertaRequest;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Scopes\PessoasPorOferta;

class OfertaController extends AppBaseController
{
    /** @var  OfertaRepository */
    private $ofertaRepository;

    public function __construct(OfertaRepository $ofertaRepo)
    {
        $this->ofertaRepository = $ofertaRepo;
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

        $hasFoto = $request->hasFile('foto_oferta');

        if ($hasFoto) {
            $foto = $request->file('foto_oferta');
            $foto_original_name = $foto->getClientOriginalName();
            $foto_path = $foto->storeAs('public', $foto_original_name);
            $input['foto_oferta'] = $foto_original_name;
        }

        $oferta = $this->ofertaRepository->create($input);

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

        $hasFoto = $request->hasFile('foto_oferta');

        if ($hasFoto) {
            $foto = $request->file('foto_oferta');
            $foto_original_name = $foto->getClientOriginalName();
            $foto_path = $foto->storeAs('public', $foto_original_name);
            $input['foto_oferta'] = $foto_original_name;
        }

        $oferta = $this->ofertaRepository->update($input, $id);

        Flash::success('Oferta atualizada com sucesso.');

        return redirect(route('ofertas.index'));
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
