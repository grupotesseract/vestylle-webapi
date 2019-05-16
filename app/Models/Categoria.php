<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $fillable = [
        'descricao',
        'conteudo',
        'valor'
    ];    

    public function pessoas() 
    {
        return $this->morphedByMany('App\Models\Pessoa', 'owner', 'segmentacoes');
    }

    public function ofertas() 
    {
        return $this->morphedByMany('App\Models\Oferta', 'owner', 'segmentacoes');
    }

    public function cupons() 
    {
        return $this->morphedByMany('App\Models\Cupon', 'owner', 'segmentacoes');
    }
}

