<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use App\DataTables\CuponDataTable;
use App\DataTables\PessoaDataTable;
use App\DataTables\OfertaDataTable;
use App\DataTables\CategoriaDataTable;
use App\Repositories\CategoriaRepository;
use App\DataTables\Scopes\CuponsPorCategoria;
use App\DataTables\Scopes\PessoasPorCategoria;
use App\DataTables\Scopes\OfertasPorCategoria;

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
     * Display the specified Categoria.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoria = $this->categoriaRepository->findWithoutFail($id);

        if (empty($categoria)) {
            Flash::error('Categoria não encontrada');
            return redirect(route('categorias.index'));
        }

        return view('categorias.show')->with('categoria', $categoria);
    }

    /**
     * Serve a view com a datatable de pessoas que tenham a categoria
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showPessoas(PessoaDataTable $pessoaDataTable, $id)
    {
        $categoria = $this->categoriaRepository->findWithoutFail($id);

        if (empty($categoria)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('categorias.index'));
        }

        return $pessoaDataTable->addScope(new PessoasPorCategoria($id))
            ->render('categorias.pessoas', compact('categoria'));
    }

    /**
     * Serve a view com a datatable de ofertas que tenham a categoria
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showOfertas(OfertaDataTable $ofertaDataTable, $id)
    {
        $categoria = $this->categoriaRepository->findWithoutFail($id);

        if (empty($categoria)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('categorias.index'));
        }

        return $ofertaDataTable->addScope(new OfertasPorCategoria($id))
            ->render('categorias.ofertas', compact('categoria'));
    }

    /**
     * Serve a view com a datatable de cupons que tenham a categoria
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showCupons(CuponDataTable $cuponDataTable, $id)
    {
        $categoria = $this->categoriaRepository->findWithoutFail($id);

        if (empty($categoria)) {
            Flash::error('Cupom não encontrado');

            return redirect(route('categorias.index'));
        }

        return $cuponDataTable->addScope(new CuponsPorCategoria($id))
            ->render('categorias.cupons', compact('categoria'));
    }
}
