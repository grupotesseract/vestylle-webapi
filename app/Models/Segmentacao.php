<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segmentacao extends Model
{
    
    public $fillable = [
        'descricao',
        'conteudo',
        'valor'
    ];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'segmentacoes';

     /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function categorias()
    {
        return $this->hasMany('App\Models\Categoria');
    }

}
