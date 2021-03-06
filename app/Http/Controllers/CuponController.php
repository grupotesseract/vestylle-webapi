<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Cupon;
use App\Models\Oferta;
use App\Models\Pessoa;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\DataTables\CuponDataTable;
use App\DataTables\PessoaDataTable;
use App\DataTables\PessoasAtivaramCupomDataTable;
use App\Repositories\FotoRepository;
use App\Repositories\CuponRepository;
use App\Jobs\SincronizarComCloudinary;
use App\Repositories\PessoaRepository;
use App\Http\Requests\CreateCuponRequest;
use App\Http\Requests\UpdateCuponRequest;
use App\DataTables\Scopes\PessoasPorCupon;
use App\DataTables\Scopes\PessoasAtivaramCupom;
use App\DataTables\Scopes\PessoasPorNCategorias;
use App\Http\Controllers\AppBaseController;

class CuponController extends AppBaseController
{
    /** @var  CuponRepository */
    private $cuponRepository;
    private $fotoRepository;
    private $pessoaRepository;

    public function __construct(CuponRepository $cuponRepo, FotoRepository $fotoRepo, PessoaRepository $pessoaRepo)
    {
        $this->cuponRepository = $cuponRepo;
        $this->fotoRepository = $fotoRepo;
        $this->pessoaRepository = $pessoaRepo;
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
        $ofertas = Oferta::get(['id', 'titulo']);
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
        $fotos = $request->allFiles()['files'] ?? false;
        $hasFotos = !empty($fotos);

        //Se o cupom não aparece na listagem, atualizar campo.
        if (!$request->aparece_listagem) {
            $input['aparece_listagem'] = false;
        }

        $cupon = $this->cuponRepository->create($input);

        if ($hasFotos) {
            $fotos = $this->fotoRepository->uploadAndCreate($request);
            $cupon->fotos()->saveMany($fotos);

            //Upload p/ Cloudinary e delete local
            foreach ($fotos as $foto) {
                $this->dispatch(new SincronizarComCloudinary($foto));
            }
        }

        //Se aparece na listagem e também na home, tratar foto home
        if ($request->em_destaque && $request->aparece_listagem) {
            $fotoDestaque = $request->allFiles()['foto_homepage'] ?? false;
            if (!empty($fotoDestaque)) {
                $cupon->fotoDestaque()->delete();
                $objFotoDestaque = $this->fotoRepository->uploadAndCreate($fotoDestaque);
                $objFotoDestaque = array_pop($objFotoDestaque);
                $objFotoDestaque->update(['tipo' => \App\Models\Foto::TIPO_DESTAQUE_CUPOM]);
                $cupon->fotos()->save($objFotoDestaque);
                $this->dispatch(new SincronizarComCloudinary($objFotoDestaque));
            }
        }

        //Se nao vier foto em destaque entao remover caso tenha foto anterior
        else {
            if ($cupon->emDestaque) {
                $cupon->fotoDestaque()->delete();
            }
        }

        //pegando categorias da request, se nao tiver,
        //usar array vazio para remover categorias
        $categorias = $request->categorias ?? [];
        $cupon->categorias()->sync($categorias);

        Flash::success('Cupom criado com sucesso.');

        return redirect(route('cupons.show', $cupon));
    }

    /**
     * Display the specified Cupon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(PessoasAtivaramCupomDataTable $pessoaDataTable, $id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);
        $mostrarBtnBaixaCaixa = true;

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');
            return redirect(route('cupons.index'));
        }

        return $pessoaDataTable->addScope(new PessoasAtivaramCupom($id))
            ->render('cupons.show', compact('cupon', $mostrarBtnBaixaCaixa));
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

        $ofertas = Oferta::get(['id', 'titulo']);
        return view('cupons.edit')->with(compact('cupon', 'ofertas'));
    }

    /**
     * Update the specified Cupon in storage.
     *
     * @param  int              $idCupom
     * @param UpdateCuponRequest $request
     *
     * @return Response
     */
    public function update(UpdateCuponRequest $request, $idCupom)
    {
        $input = $request->all();
        $cupon = $this->cuponRepository->findWithoutFail($idCupom);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');
            return redirect(route('cupons.index'));
        }

        $fotos = $request->allFiles()['files'] ?? false;
        $hasFotos = !empty($fotos);
        $canUpload  = $hasFotos ? \App\Helpers\Helpers::checkUploadLimit($cupon, count($fotos)) : true;

        if ($canUpload == false) {
            Flash::error('Número máximo de imagens atingido. Tente novamente');
            return redirect(route('cupons.edit', $cupon));
        }

        if ($hasFotos) {
            $fotos = $this->fotoRepository->uploadAndCreate($request);
            $cupon->fotos()->saveMany($fotos);

            foreach ($fotos as $foto) {
                $this->dispatch(new SincronizarComCloudinary($foto));
            }
        }

        //Se o cupom não aparece na listagem, atualizar campo.
        if (!$request->aparece_listagem) {
            $input['aparece_listagem'] = false;
        }

        //Se aparece na listagem e também na home, tratar foto home
        if ($request->em_destaque && $request->aparece_listagem) {
            $fotoDestaque = $request->allFiles()['foto_homepage'] ?? false;
            if (!empty($fotoDestaque)) {
                $cupon->fotoDestaque()->delete();
                $objFotoDestaque = $this->fotoRepository->uploadAndCreate($fotoDestaque);
                $objFotoDestaque = array_pop($objFotoDestaque);
                $objFotoDestaque->update(['tipo' => \App\Models\Foto::TIPO_DESTAQUE_CUPOM]);
                $cupon->fotos()->save($objFotoDestaque);
                $this->dispatch(new SincronizarComCloudinary($objFotoDestaque));
            }
        }

        //Se nao vier foto em destaque entao remover caso tenha foto anterior
        else {
            if ($cupon->emDestaque) {
                $cupon->fotoDestaque()->delete();
            }
        }


        //pegando categorias da request, se nao tiver,
        //usar array vazio para remover categorias
        $categorias = $request->categorias ?? [];
        $cupon->categorias()->sync($categorias);

        $cupon = $this->cuponRepository->update($input, $idCupom);

        Flash::success('Cupom atualizado com sucesso.');

        return redirect(route('cupons.show', $cupon));
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

    /**
     * Marca um cupon como utilizado pela pessoa X
     *
     * @return void
     */
    public function setUtilizadoVenda($id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');
            return redirect(route('cupons.index'));
        }

        $pessoa = $this->pessoaRepository->findWithoutFail(\Request::get('pessoa_id'));

        if (!$pessoa) {
            Flash::error('Pessoa não encontrada');
            return redirect()->back();
        }

        $pessoa->cupons()->updateExistingPivot($cupon->id, ['cupom_utilizado_venda' => true]);

        Flash::success('Cupom marcado como utilizado');
        return redirect()->back();
    }

    /**
     * Serve a view com a datatable de pessoas que podem ver esse cupon
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showPessoasPermitidas(PessoaDataTable $pessoaDataTable, $id)
    {
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            Flash::error('Cupom não encontrado');
            return redirect(route('cupons.index'));
        }

        //Se tiver categorias, então existe segmentacao, logo é necessario aplicar scope
        if ($cupon->categorias()->count()) {
            $idsCategorias = $cupon->categorias->pluck('id');
            return $pessoaDataTable
               ->addScope(new PessoasPorNCategorias($idsCategorias))
               ->render('cupons.pessoas', compact('cupon'));
        }

        return $pessoaDataTable
            ->render('cupons.pessoas', compact('cupon'));
    }
}
