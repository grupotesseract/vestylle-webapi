<?php

namespace App\Http\Controllers;

use App\DataTables\LojaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLojaRequest;
use App\Http\Requests\UpdateLojaRequest;
use App\Repositories\LojaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LojaController extends AppBaseController
{
    /** @var  LojaRepository */
    private $lojaRepository;

    public function __construct(LojaRepository $lojaRepo)
    {
        $this->lojaRepository = $lojaRepo;
    }

    /**
     * Display a listing of the Loja.
     *
     * @param LojaDataTable $lojaDataTable
     * @return Response
     */
    public function index(LojaDataTable $lojaDataTable)
    {
        return $lojaDataTable->render('lojas.index');
    }

    /**
     * Show the form for creating a new Loja.
     *
     * @return Response
     */
    public function create()
    {
        return view('lojas.create');
    }

    /**
     * Store a newly created Loja in storage.
     *
     * @param CreateLojaRequest $request
     *
     * @return Response
     */
    public function store(CreateLojaRequest $request)
    {
        $input = $request->all();

        $loja = $this->lojaRepository->create($input);

        Flash::success('Loja saved successfully.');

        return redirect(route('lojas.index'));
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
    public function update($id, UpdateLojaRequest $request)
    {
        $loja = $this->lojaRepository->findWithoutFail($id);

        if (empty($loja)) {
            Flash::error('Loja not found');

            return redirect(route('lojas.index'));
        }

        $loja = $this->lojaRepository->update($request->all(), $id);

        Flash::success('Loja updated successfully.');

        return redirect(route('lojas.index'));
    }

    /**
     * Remove the specified Loja from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loja = $this->lojaRepository->findWithoutFail($id);

        if (empty($loja)) {
            Flash::error('Loja not found');

            return redirect(route('lojas.index'));
        }

        $this->lojaRepository->delete($id);

        Flash::success('Loja deleted successfully.');

        return redirect(route('lojas.index'));
    }
}
