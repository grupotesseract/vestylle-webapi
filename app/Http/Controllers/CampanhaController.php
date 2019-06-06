<?php

namespace App\Http\Controllers;

use App\DataTables\CampanhaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCampanhaRequest;
use App\Http\Requests\UpdateCampanhaRequest;
use App\Repositories\CampanhaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

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
        return view('campanhas.create');
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

        Flash::success('Campanha saved successfully.');

        return redirect(route('campanhas.index'));
    }

    /**
     * Display the specified Campanha.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $campanha = $this->campanhaRepository->findWithoutFail($id);

        if (empty($campanha)) {
            Flash::error('Campanha not found');

            return redirect(route('campanhas.index'));
        }

        return view('campanhas.show')->with('campanha', $campanha);
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
            Flash::error('Campanha not found');

            return redirect(route('campanhas.index'));
        }

        return view('campanhas.edit')->with('campanha', $campanha);
    }

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
            Flash::error('Campanha not found');

            return redirect(route('campanhas.index'));
        }

        $campanha = $this->campanhaRepository->update($request->all(), $id);

        Flash::success('Campanha updated successfully.');

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
            Flash::error('Campanha not found');

            return redirect(route('campanhas.index'));
        }

        $this->campanhaRepository->delete($id);

        Flash::success('Campanha deleted successfully.');

        return redirect(route('campanhas.index'));
    }
}
