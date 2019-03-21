<?php

namespace App\Http\Controllers;

use App\DataTables\FaleConoscoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFaleConoscoRequest;
use App\Http\Requests\UpdateFaleConoscoRequest;
use App\Repositories\FaleConoscoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FaleConoscoController extends AppBaseController
{
    /** @var  FaleConoscoRepository */
    private $faleConoscoRepository;

    public function __construct(FaleConoscoRepository $faleConoscoRepo)
    {
        $this->faleConoscoRepository = $faleConoscoRepo;
    }

    /**
     * Display a listing of the FaleConosco.
     *
     * @param FaleConoscoDataTable $faleConoscoDataTable
     * @return Response
     */
    public function index(FaleConoscoDataTable $faleConoscoDataTable)
    {
        return $faleConoscoDataTable->render('fale_conoscos.index');
    }

    /**
     * Show the form for creating a new FaleConosco.
     *
     * @return Response
     */
    public function create()
    {
        return view('fale_conoscos.create');
    }

    /**
     * Store a newly created FaleConosco in storage.
     *
     * @param CreateFaleConoscoRequest $request
     *
     * @return Response
     */
    public function store(CreateFaleConoscoRequest $request)
    {
        $input = $request->all();

        $faleConosco = $this->faleConoscoRepository->create($input);

        Flash::success('Fale Conosco saved successfully.');

        return redirect(route('faleConoscos.index'));
    }

    /**
     * Display the specified FaleConosco.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faleConosco = $this->faleConoscoRepository->findWithoutFail($id);

        if (empty($faleConosco)) {
            Flash::error('Fale Conosco not found');

            return redirect(route('faleConoscos.index'));
        }

        return view('fale_conoscos.show')->with('faleConosco', $faleConosco);
    }

    /**
     * Show the form for editing the specified FaleConosco.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faleConosco = $this->faleConoscoRepository->findWithoutFail($id);

        if (empty($faleConosco)) {
            Flash::error('Fale Conosco not found');

            return redirect(route('faleConoscos.index'));
        }

        return view('fale_conoscos.edit')->with('faleConosco', $faleConosco);
    }
}
