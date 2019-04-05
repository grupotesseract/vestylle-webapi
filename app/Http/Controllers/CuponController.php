<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Oferta;
use App\Models\Pessoa;
use App\Http\Requests;
use App\DataTables\CuponDataTable;
use App\DataTables\PessoaDataTable;
use App\Repositories\CuponRepository;
use App\Http\Requests\CreateCuponRequest;
use App\Http\Requests\UpdateCuponRequest;
use App\DataTables\Scopes\PessoasPorCupon;
use App\Http\Controllers\AppBaseController;

class CuponController extends AppBaseController
{
    /** @var  CuponRepository */
    private $cuponRepository;

    public function __construct(CuponRepository $cuponRepo)
    {
        $this->cuponRepository = $cuponRepo;
    }

    /**
     * Display a listing of the Cupon.
     *
     * @param CuponDataTable $cuponDataTable
     * @return Response
     */
    public function index(CuponDataTable $cuponDataTable)
    {
        return $cuponDataTable->render('cupons.index');
    }

    /**
     * Show the form for creating a new Cupon.
     *
     * @return Response
     */
    public function create()
    {
        $ofertas = Oferta::get(['id', 'descricao_oferta']);
        return view('cupons.create')->with(compact('ofertas'));
    }

    /**
     * Store a newly created Cupon in storage.
     *
     * @param CreateCuponRequest $request
     *
     * @return Response
     */
    public function store(CreateCuponRequest $request)
    {
        $input = $request->all();

        $input['cupom_primeiro_login'] = isset($input['cupom_primeiro_login']) ? true : false;

        $hasFoto = $request->hasFile('foto_caminho');

        if ($hasFoto) {
            $foto = $request->file('foto_caminho');
            $foto_original_name = $foto->getClientOriginalName();
            $foto_path = $foto->storeAs('public', $foto_original_name);
            $input['foto_caminho'] = $foto_original_name;
        }

        $cupon = $this->cuponRepository->create($input);

        Flash::success('Cupom criado com sucesso.');

        return redirect(route('cupons.index'));
    }

    /**
     * Display the specified Cupon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(PessoaDataTable $pessoaDataTable, $id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('cupons.index'));
        }

        return $pessoaDataTable->addScope(new PessoasPorCupon($id))
            ->render('cupons.show', compact('cupon'));
    }

    /**
     * Show the form for editing the specified Cupon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('cupons.index'));
        }

        $ofertas = Oferta::get(['id', 'descricao_oferta']);
        return view('cupons.edit')->with(compact('cupon', 'ofertas'));
    }

    /**
     * Update the specified Cupon in storage.
     *
     * @param  int              $id
     * @param UpdateCuponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCuponRequest $request)
    {
        $input = $request->all();
        $input['cupom_primeiro_login'] = isset($input['cupom_primeiro_login']) ? true : false;
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('cupons.index'));
        }

        $hasFoto = $request->hasFile('foto_caminho');

        if ($hasFoto) {
            $foto = $request->file('foto_caminho');
            $foto_original_name = $foto->getClientOriginalName();
            $foto_path = $foto->storeAs('public', $foto_original_name);
            $input['foto_caminho'] = $foto_original_name;
        }

        $cupon = $this->cuponRepository->update($input, $id);

        Flash::success('Cupom atualizado com sucesso.');

        return redirect(route('cupons.index'));
    }

    /**
     * Remove the specified Cupon from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('cupons.index'));
        }

        $this->cuponRepository->delete($id);

        Flash::success('Cupom excluído com sucesso.');

        return redirect(route('cupons.index'));
    }

    /**
     * Traz todos os cupons relacionados a uma pessoa
     *
     * @param int $pessoa_id
     *
     * @return Response
     */
    public function getCuponsPessoa($pessoa_id)
    {
        $pessoa = Pessoa::find($pessoa_id);

        if (!$pessoa) {
           return Response::json('Pessoa não encontrada', 404);
        }

        $cupons = $pessoa->cupons->all();

        return Response::json($cupons, 200);
    }
}
