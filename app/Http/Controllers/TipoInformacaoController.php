<?php

namespace App\Http\Controllers;

use App\DataTables\TipoInformacaoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTipoInformacaoRequest;
use App\Http\Requests\UpdateTipoInformacaoRequest;
use App\Repositories\TipoInformacaoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TipoInformacaoController extends AppBaseController
{
    /** @var  TipoInformacaoRepository */
    private $tipoInformacaoRepository;

    public function __construct(TipoInformacaoRepository $tipoInformacaoRepo)
    {
        $this->tipoInformacaoRepository = $tipoInformacaoRepo;
    }

    /**
     * Display a listing of the TipoInformacao.
     *
     * @param TipoInformacaoDataTable $tipoInformacaoDataTable
     * @return Response
     */
    public function index(TipoInformacaoDataTable $tipoInformacaoDataTable)
    {
        return $tipoInformacaoDataTable->render('tipo_informacaos.index');
    }

    /**
     * Show the form for creating a new TipoInformacao.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_informacaos.create');
    }

    /**
     * Store a newly created TipoInformacao in storage.
     *
     * @param CreateTipoInformacaoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoInformacaoRequest $request)
    {
        $input = $request->all();

        $tipoInformacao = $this->tipoInformacaoRepository->create($input);

        Flash::success('Tipo de Informação salvo com sucesso.');

        return redirect(route('tipoInformacaos.index'));
    }

    /**
     * Display the specified TipoInformacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoInformacao = $this->tipoInformacaoRepository->findWithoutFail($id);

        if (empty($tipoInformacao)) {
            Flash::error('Tipo de Informação não encontrado');

            return redirect(route('tipoInformacaos.index'));
        }

        return view('tipo_informacaos.show')->with('tipoInformacao', $tipoInformacao);
    }

    /**
     * Show the form for editing the specified TipoInformacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoInformacao = $this->tipoInformacaoRepository->findWithoutFail($id);

        if (empty($tipoInformacao)) {
            Flash::error('Tipo de Informação não encontrado');

            return redirect(route('tipoInformacaos.index'));
        }

        return view('tipo_informacaos.edit')->with('tipoInformacao', $tipoInformacao);
    }

    /**
     * Update the specified TipoInformacao in storage.
     *
     * @param  int              $id
     * @param UpdateTipoInformacaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoInformacaoRequest $request)
    {
        $tipoInformacao = $this->tipoInformacaoRepository->findWithoutFail($id);

        if (empty($tipoInformacao)) {
            Flash::error('Tipo de Informação não encontrado');

            return redirect(route('tipoInformacaos.index'));
        }

        $tipoInformacao = $this->tipoInformacaoRepository->update($request->all(), $id);

        Flash::success('Tipo de Informação atualizado com sucesso.');

        return redirect(route('tipoInformacaos.index'));
    }

    /**
     * Remove the specified TipoInformacao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoInformacao = $this->tipoInformacaoRepository->findWithoutFail($id);

        if (empty($tipoInformacao)) {
            Flash::error('Tipo de Informação não encontrado');

            return redirect(route('tipoInformacaos.index'));
        }

        $this->tipoInformacaoRepository->delete($id);

        Flash::success('Tipo de Informação excluído com sucesso');

        return redirect(route('tipoInformacaos.index'));
    }
}
