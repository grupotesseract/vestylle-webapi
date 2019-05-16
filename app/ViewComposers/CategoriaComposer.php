<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Repositories\CategoriaRepository;

class CategoriaComposer
{
    protected $categoriaRepository;

    /**
     * __construct
     *
     * @param CategoriaRepository $categoriaRepository
     */
    public function __construct(CategoriaRepository $categoriaRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->categoriaRepository = $categoriaRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categorias', $this->categoriaRepository->getCategoriasSelect());
    }
}
