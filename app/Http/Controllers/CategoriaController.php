<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use App\DataTables\PessoaDataTable;
use App\DataTables\CategoriaDataTable;
use App\Repositories\CategoriaRepository;

class CategoriaController extends Controller
{
    private $categoriaRepository;

    /**
     * @param CategoriaRepository $categoriaRepository
     */
    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }


    /**
     * Display a listing of the Categoria.
     *
     * @param CategoriaDataTable $categoriaDataTable
     * @return Response
     */
    public function index(CategoriaDataTable $categoriaDataTable)
    {
        return $categoriaDataTable->render('categorias.index');
    }

    /**
     * Display the specified .
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

        return $pessoaDataTable->addScope(new PessoasPorCategoria($id))
            ->render('categorias.show', compact('categoria'));
    }

}
