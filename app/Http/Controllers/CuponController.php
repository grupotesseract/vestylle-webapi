<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\DataTables\CuponDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCuponRequest;
use App\Http\Requests\UpdateCuponRequest;
use App\Repositories\CuponRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

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

        $cupon = $this->cuponRepository->create($input);

        Flash::success('Cupon saved successfully.');

        return redirect(route('cupons.index'));
    }

    /**
     * Display the specified Cupon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupon not found');

            return redirect(route('cupons.index'));
        }

        return view('cupons.show')->with('cupon', $cupon);
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
            Flash::error('Cupon not found');

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
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupon not found');

            return redirect(route('cupons.index'));
        }

        $cupon = $this->cuponRepository->update($request->all(), $id);

        Flash::success('Cupon updated successfully.');

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
            Flash::error('Cupon not found');

            return redirect(route('cupons.index'));
        }

        $this->cuponRepository->delete($id);

        Flash::success('Cupon deleted successfully.');

        return redirect(route('cupons.index'));
    }
}
