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


    protected $appends = [
        'nome'
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

    /**
     * Acessor para obter o 'nome' da categoria.
     * Nome = descricao + conteudo + valor
     *
     * @return string
     */
    public function getNomeAttribute()
     {
        return $this->descricao. ' ' . $this->conteudo . $this->valor;
     }

    /**
     * Acessor para obter o campo Conteudo sem '0.00'
     *
     * @return string
     */
     public function getConteudoAttribute($value)
     {
        return $value == '0.00' ? '' : $value;
     }

    /**
     * Acessor para obter o campo Valor sem '0.00'
     *
     * @return string
     */
     public function getValorAttribute($value)
     {
        return $value == '0.00' ? '' : $value;
     }
}

