<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Campanha
 * @package App\Models
 * @version June 6, 2019, 10:39 pm UTC
 *
 * @property string titulo
 * @property string texto
 * @property integer cupon_id
 * @property integer oferta_id
 * @property integer genero
 * @property string data_ultima_compra_menor
 * @property string data_ultima_compra_maior
 * @property string data_vencimento_pontos_menor
 * @property string data_vencimento_pontos_maior
 * @property integer ano_nascimento
 * @property string condicao_ano_nascimento
 * @property integer mes_aniversario
 * @property string condicao_mes_aniversario
 * @property integer saldo_pontos
 * @property string condicao_saldo_pontos
 */
class Campanha extends Model
{

    public $table = 'campanhas';

    public $fillable = [
        'titulo',
        'texto',
        'cupon_id',
        'oferta_id',
        'genero',
        'data_ultima_compra_menor',
        'data_ultima_compra_maior',
        'data_vencimento_pontos_menor',
        'data_vencimento_pontos_maior',
        'ano_nascimento',
        'condicao_ano_nascimento',
        'mes_aniversario',
        'condicao_mes_aniversario',
        'saldo_pontos',
        'condicao_saldo_pontos'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'titulo' => 'string',
        'texto' => 'string',
        'cupon_id' => 'integer',
        'oferta_id' => 'integer',
        'genero' => 'integer',
        'ano_nascimento' => 'integer',
        'condicao_ano_nascimento' => 'string',
        'mes_aniversario' => 'integer',
        'condicao_mes_aniversario' => 'string',
        'saldo_pontos' => 'integer',
        'condicao_saldo_pontos' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'texto' => 'required'
    ];


}
