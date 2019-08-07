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
use Illuminate\Foundation\Auth\ResetsPasswords;


class PessoaController extends AppBaseController
{
    use ResetsPasswords;

    /** @var  PessoaRepository */
    private $pessoaRepository;

    protected $redirectTo = '/password/success';


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

        Flash::success('Pessoa criada com sucesso.');

        return view('pessoas.show')->with('pessoa', $pessoa);
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
            Flash::error('Pessoa não encontrada');

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
            Flash::error('Pessoa não encontrada');

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
            Flash::error('Pessoa não encontrada');

            return redirect(route('pessoas.index'));
        }

        $pessoa = $this->pessoaRepository->update($request->all(), $id);

        Flash::success('Pessoa atualizada com sucesso.');

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
            Flash::error('Pessoa não encontrada');

            return redirect(route('pessoas.index'));
        }        

        $pessoa->cupons()->detach();
        $pessoa->listaDesejos()->detach();
        $pessoa->categorias()->detach();
        $pessoa->faleConoscos()->forceDelete();

        $this->pessoaRepository->delete($id);

        Flash::success('Pessoa excluída com sucesso.');

        return redirect(route('pessoas.index'));
    }

    /**
     * Form de senha redefinida com sucesso
     *
     * @return Response
     */
    public function resetSuccess()
    {
        return view('auth.passwords.reset_success');
    }
}
