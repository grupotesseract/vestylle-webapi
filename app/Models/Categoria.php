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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function segmentacoes()
    {
        return $this->hasMany('App\Models\Segmentacao');
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

