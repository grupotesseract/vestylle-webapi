<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Repositories\PessoaRepository;

class PessoaGeneroComposer
{
    protected $pessoaRepository;

    /**
     * __construct
     *
     * @param PessoaRepository $pessoaRepository
     */
    public function __construct(PessoaRepository $pessoaRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->pessoaRepository = $pessoaRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('generos', $this->pessoaRepository->getPessoaGenerosSelect());
        return $view;
    }
}
