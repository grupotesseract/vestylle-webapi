<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuponPessoa extends Model
{
    public $table = 'cupons_pessoas';

    public $fillable = [
        'cupom_id',
        'pessoa_id',
        'codigo_unico',
    ];

    /**
     * Relacionamento 1x1 com pessoa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pessoa()
    {
        return $this->belongsTo('App\Models\Pessoa', 'pessoa_id');
    }

    /**
     * Relacionamento 1x1 com cupom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cupom()
    {
        return $this->belongsTo('App\Models\Cupon', 'cupom_id');
    }
}
