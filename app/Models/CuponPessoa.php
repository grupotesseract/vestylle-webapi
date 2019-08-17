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
        'data_expiracao'
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

    /**
     * Retorna true se o cupom já foi ativado pra uma determinada pessoa
     *
     * @param $cupom_id id do cupom
     * @param $pessoa_id id da pessoa
     *
     * @return false || (array)Cupom
     */
    public static function jaFoiAtivado($cupom_id, $pessoa_id)
    {
        $ativado = \App\Models\CuponPessoa::where([
            'cupom_id' => $cupom_id,
            'pessoa_id' => $pessoa_id,
        ])->exists();

        if ($ativado) {
            $cupom_pessoa = \App\Models\CuponPessoa::where([ 'cupom_id' => $cupom_id, 'pessoa_id' => $pessoa_id, ])->first();
            $cupom = $cupom_pessoa->cupom->toArray();
            $cupom['codigo_unico'] = $cupom_pessoa->codigo_unico;
            $cupom['data_validade'] = $cupom_pessoa->data_expiracao;

            return $cupom;
        }

        return false;
    }
}
