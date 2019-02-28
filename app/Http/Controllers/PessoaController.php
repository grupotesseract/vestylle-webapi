<?php

namespace App\Http\Controllers;

use App\DataTables\PessoaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Repositories\PessoaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PessoaController extends AppBaseController
{
    /** @var  PessoaRepository */
    private $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepo)
    {
        $this->pessoaRepository = $pessoaRepo;
    }

    /**
     * Display a listing of the Pessoa.
     *
     * @param PessoaDataTable $pessoaDataTable
     * @return Response
     */
    public function index(PessoaDataTable $pessoaDataTable)
    {
        return $pessoaDataTable->render('pessoas.index');
    }

    /**
     * Show the form for creating a new Pessoa.
     *
     * @return Response
     */
    public function create()
    {
        return view('pessoas.create');
    }

    /**
     * Store a newly created Pessoa in storage.
     *
     * @param CreatePessoaRequest $request
     *
     * @return Response
     */
    public function store(CreatePessoaRequest $request)
    {
        $input = $request->all();

        $pessoa = $this->pessoaRepository->create($input);

        Flash::success('Pessoa saved successfully.');

        return redirect(route('pessoas.index'));
    }

    /**
     * Display the specified Pessoa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            Flash::error('Pessoa not found');

            return redirect(route('pessoas.index'));
        }

        return view('pessoas.show')->with('pessoa', $pessoa);
    }

    /**
     * Show the form for editing the specified Pessoa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            Flash::error('Pessoa not found');

            return redirect(route('pessoas.index'));
        }

        return view('pessoas.edit')->with('pessoa', $pessoa);
    }

    /**
     * Update the specified Pessoa in storage.
     *
     * @param  int              $id
     * @param UpdatePessoaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePessoaRequest $request)
    {
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            Flash::error('Pessoa not found');

            return redirect(route('pessoas.index'));
        }

        $pessoa = $this->pessoaRepository->update($request->all(), $id);

        Flash::success('Pessoa updated successfully.');

        return redirect(route('pessoas.index'));
    }

    /**
     * Remove the specified Pessoa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            Flash::error('Pessoa not found');

            return redirect(route('pessoas.index'));
        }

        $this->pessoaRepository->delete($id);

        Flash::success('Pessoa deleted successfully.');

        return redirect(route('pessoas.index'));
    }
}
