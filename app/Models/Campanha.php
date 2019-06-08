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
 * @property string genero
 * @property string data_ultima_compra_menor
 * @property string data_ultima_compra_maior
 * @property string data_vencimento_pontos_menor
 * @property string data_vencimento_pontos_maior
 * @property integer idade
 * @property string condicao_idade
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
        'idade',
        'condicao_idade',
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
        'genero' => 'string',
        'idade' => 'integer',
        'condicao_idade' => 'string',
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

    /**
     * Mutator para a data_vencimento_pontos_menor
     */
    public function setDataVencimentoPontosMenorAttribute($value)
    {
        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_vencimento_pontos_menor'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_vencimento_pontos_menor'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }

    /**
     * Mutator para a data_vencimento_pontos_maior
     */
    public function setDataVencimentoPontosmaiorAttribute($value)
    {
        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_vencimento_pontos_maior'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_vencimento_pontos_maior'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }


    /**
     * Relacionamento N x N entre Campanha e Categorias (polimórfico)
     *
     * @return void
     */
    public function categorias()
    {
        return $this->morphToMany('App\Models\Categoria', 'owner', 'segmentacoes');
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por categorias
     *
     * @return boolean
     */
    public function getTemSegmentacaoCategoriaAttribute()
    {
        return $this->categorias()->count() ? true : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por genero
     *
     * @return boolean
     */
    public function getTemSegmentacaoGeneroAttribute()
    {
        return $this->genero ? true : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por idade
     *
     * @return boolean
     */
    public function getTemSegmentacaoIdadeAttribute()
    {
        return $this->idade ? true : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por mes de aniversario
     *
     * @return boolean
     */
    public function getTemSegmentacaoAniversarioAttribute()
    {
        return $this->mes_aniversario ? true : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por saldo de pontos
     *
     * @return boolean
     */
    public function getTemSegmentacaoPontosAttribute()
    {
        return $this->saldo_pontos ? true : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por data de vencimento dos pontos
     *
     * @return boolean
     */
    public function getTemSegmentacaoVencimentoPontosAttribute()
    {
        return ($this->data_vencimento_pontos_menor && $this->data_vencimento_pontos_menor)
            ? true
            : false;
    }
}
