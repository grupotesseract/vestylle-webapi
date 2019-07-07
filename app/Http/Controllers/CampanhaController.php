<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Cupon;
use App\Models\Oferta;
use App\DataTables\CampanhaDataTable;
use App\Repositories\CampanhaRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCampanhaRequest;
use App\DataTables\Scopes\PessoasPorCampanha;
use App\Http\Requests\UpdateCampanhaRequest;
use App\DataTables\PessoaDataTable;

class CampanhaController extends AppBaseController
{
    /** @var  CampanhaRepository */
    private $campanhaRepository;

    public function __construct(CampanhaRepository $campanhaRepo)
    {
        $this->campanhaRepository = $campanhaRepo;
    }

    /**
     * Display a listing of the Campanha.
     *
     * @param CampanhaDataTable $campanhaDataTable
     * @return Response
     */
    public function index(CampanhaDataTable $campanhaDataTable)
    {
        return $campanhaDataTable->render('campanhas.index');
    }

    /**
     * Show the form for creating a new Campanha.
     *
     * @return Response
     */
    public function create()
    {
        $ofertas = Oferta::get(['id', 'titulo']);
        $cupons = Cupon::get(['id', 'titulo']);
        return view('campanhas.create')->with(compact('ofertas', 'cupons'));
    }

    /**
     * Store a newly created Campanha in storage.
     *
     * @param CreateCampanhaRequest $request
     *
     * @return Response
     */
    public function store(CreateCampanhaRequest $request)
    {
        $input = $request->all();

        $campanha = $this->campanhaRepository->create($input);

        $this->campanhaRepository->trataRequestCampanhas($request, $campanha);

        Flash::success('Campanha criada com sucesso.');

        return redirect(route('campanhas.index'));
    }

    /**
     * Display the specified Campanha.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(PessoaDataTable $pessoaDataTable, $idCampanha)
    {
        $campanha = $this->campanhaRepository->findWithoutFail($idCampanha);

        if (empty($campanha)) {
            Flash::error('Campanha não encontrada');
            return redirect(route('campanhas.index'));
        }

        return $pessoaDataTable->addScope(new PessoasPorCampanha($idCampanha))
            ->render('campanhas.show', compact('campanha'));
    }

    /**
     * Show the form for editing the specified Campanha.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $campanha = $this->campanhaRepository->findWithoutFail($id);

        if (empty($campanha)) {
            Flash::error('Campanha não encontrada');

            return redirect(route('campanhas.index'));
        }

        $ofertas = Oferta::get(['id', 'titulo']);
        $cupons = Cupon::get(['id', 'titulo']);
        return view('campanhas.edit')->with(compact('campanha', 'ofertas', 'cupons'));    }

    /**
     * Update the specified Campanha in storage.
     *
     * @param  int              $id
     * @param UpdateCampanhaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCampanhaRequest $request)
    {
        $campanha = $this->campanhaRepository->findWithoutFail($id);

        if (empty($campanha)) {
            Flash::error('Campanha não encontrada');
            return redirect(route('campanhas.index'));
        }

        $this->campanhaRepository->trataRequestCampanhas($request, $campanha);

        $arrInfos = $request->all();
        $campanha = $this->campanhaRepository->update($arrInfos, $id);

        Flash::success('Campanha atualizada com sucesso.');

        return redirect(route('campanhas.index'));
    }

    /**
     * Remove the specified Campanha from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $campanha = $this->campanhaRepository->findWithoutFail($id);

        if (empty($campanha)) {
            Flash::error('Campanha não encontrada');

            return redirect(route('campanhas.index'));
        }

        $this->campanhaRepository->delete($id);

        Flash::success('Campanha removida com sucesso.');

        return redirect(route('campanhas.index'));
    }
}
