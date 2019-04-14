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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function segmentacoes()
    {
        return $this->hasMany('App\Models\Segmentacao');
    }
}

