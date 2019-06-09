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
        'data_nascimento_menor',
        'data_nascimento_maior',
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
     * undocumented function
     *
     * @return void
     */
    public function cupon()
    {
        return $this->belongsTo("App\Models\Cupon");
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function oferta()
    {
        return $this->belongsTo("App\Models\Oferta");
    }


    /**
     * Mutator para a data_nascimento_menor
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataNascimentoMenorAttribute($value)
    {
        if (is_null($value)) {
            return $this->attributes['data_nascimento_menor'] = $value;
        }

        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_nascimento_menor'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_nascimento_menor'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }

    /**
     * Mutator para a data_nascimento_maior
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataNascimentoMaiorAttribute($value)
    {
        if (is_null($value)) {
            return $this->attributes['data_nascimento_maior'] = $value;
        }

        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_nascimento_maior'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_nascimento_maior'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }


    /**
     * Mutator para a data_vencimento_pontos_menor
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataVencimentoPontosMenorAttribute($value)
    {
        if (is_null($value)) {
            return $this->attributes['data_vencimento_pontos_menor'] = $value;
        }

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
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataVencimentoPontosMaiorAttribute($value)
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
     * Acessor para a data_nascimento_menor
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function getDataNascimentoMenorAttribute($value)
    {

        return is_null($value)
            ? $value
            : \Carbon\Carbon::parse($value)->format("d/m/Y");
    }

    /**
     * Acessor para a data_nascimento_maior
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function getDataNascimentoMaiorAttribute($value)
    {
        return is_null($value)
            ? $value
            : \Carbon\Carbon::parse($value)->format("d/m/Y");
    }

    /**
     * Acessor para a data_vencimento_pontos_menor
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function getDataVencimentoPontosMenorAttribute($value)
    {
        return is_null($value)
            ? $value
            : \Carbon\Carbon::parse($value)->format("d/m/Y");
    }

    /**
     * Acessor para a data_vencimento_pontos_maior
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function getDataVencimentoPontosMaiorAttribute($value)
    {
        return is_null($value)
            ? $value
            : \Carbon\Carbon::parse($value)->format("d/m/Y");
    }

    /**
     * Mutator para a data_ultima_compra_menor
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataUltimaCompraMenorAttribute($value)
    {
        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_ultima_compra_menor'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_ultima_compra_menor'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }

    /**
     * Mutator para a data_ultima_compra_maior
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataUltimaCompraMaiorAttribute($value)
    {
        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_ultima_compra_maior'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_ultima_compra_maior'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }

    /**
     * Acessor para a data_ultima_compra_menor
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function getDataUltimaCompraMenorAttribute($value)
    {
        return is_null($value)
            ? $value
            : \Carbon\Carbon::parse($value)->format("d/m/Y");
    }

    /**
     * Acessor para a data_ultima_compra_maior
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function getDataUltimaCompraMaiorAttribute($value)
    {
        return is_null($value)
            ? $value
            : \Carbon\Carbon::parse($value)->format("d/m/Y");
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
        return ($this->data_nascimento_menor && $this->data_nascimento_maior)
            ? true
            : false;
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
        return ($this->data_vencimento_pontos_menor && $this->data_vencimento_pontos_maior)
            ? true
            : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por data de ultima compra
     *
     * @return boolean
     */
    public function getTemSegmentacaoUltimaCompraAttribute()
    {
        return ($this->data_ultima_compra_menor && $this->data_ultima_compra_maior)
            ? true
            : false;
    }


    /**
     * Acessor para URL final da campanha
     */
     public function getUrlAttribute()
     {
         if ($this->cupon) {
             return env('URL_FRONT_CUPON').$this->cupon_id;
         }

         if ($this->oferta) {
             return env('URL_FRONT_OFERTA').$this->oferta_id;
         }
         return env('URL_FRONT');
     }

}
