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
 * @property string data_nascimento_pontos_menor
 * @property string data_nascimento_pontos_maior
 * @property integer mes_aniversario
 * @property string condicao_mes_aniversario
 * @property integer dia_aniversario
 * @property string condicao_dia_aniversario
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
        'dia_aniversario',
        'condicao_dia_aniversario',
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
        'dia_aniversario' => 'integer',
        'condicao_dia_aniversario' => 'string',
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

    public $appends = [
        'qntPessoas'
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
    public function getTemSegmentacaoMesAniversarioAttribute()
    {
        return ($this->condicao_mes_aniversario && $this->mes_aniversario)
            ? true
            : false;
    }

    /**
     * Acessor para determinar se essa Campanha usa segmentacao por dia de aniversario
     *
     * @return boolean
     */
    public function getTemSegmentacaoDiaAniversarioAttribute()
    {
        return ($this->condicao_dia_aniversario && $this->dia_aniversario)
            ? true
            : false;
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
     *
     * @return string - URL final da campanha
     */
     public function getUrlAttribute()
     {
         if ($this->cupon) {
             return env('URL_FRONT_CUPON_PUSH').$this->cupon_id;
         }
         if ($this->oferta) {
             return env('URL_FRONT_OFERTA_PUSH').$this->oferta_id;
         }
         return env('URL_FRONT');
     }

    /**
     * Acessor para obter a query de pessoas que cumprem os criterios de segmentacao da campanha
     *
     * @return Doctrine\DBAL\Query\QueryBuilder
     */
     public function getPessoasQueryAttribute()
     {
         $pessoas = Pessoa::query();
         $categorias = $this->categorias->pluck('id');

         //Caso Segmentacao por categoria
         if ($this->temSegmentacaoCategoria) {
             $pessoas = $pessoas->whereHas('categorias', function($qCategorias) use ($categorias) {
                 $qCategorias->whereIn("categoria_id", $categorias);
             });
         }
         //Caso segmentacao por mes de aniversario
         if ($this->temSegmentacaoMesAniversario) {
             $query = "EXTRACT(MONTH FROM data_nascimento) "
                 . $this->condicao_mes_aniversario . " " . $this->mes_aniversario;

             $pessoas = $pessoas->whereRaw($query);
         }
         //Caso segmentacao por dia de aniversario
         if ($this->temSegmentacaodiaAniversario) {
             $query = "EXTRACT(DAY FROM data_nascimento) "
                 . $this->condicao_dia_aniversario . " " . $this->dia_aniversario;

             $pessoas = $pessoas->whereRaw($query);
         }
         //Caso segmentacao por idade
         if ($this->temSegmentacaoIdade) {
             //Filtrar pessoas que tenham idade 'condicao'
             $pessoas = $pessoas->whereBetween('data_nascimento', [
                 $this->attributes['data_nascimento_menor'],
                 $this->attributes['data_nascimento_maior']
             ]);
         }
         //Caso segmentacao por genero
         if ($this->temSegmentacaoGenero) {
             $pessoas = $pessoas->where(
                 'genero',
                 $this->genero
             );
         }
         //Caso segmentacao por saldo de pontos
         if ($this->temSegmentacaoPontos) {
             //Filtrar pessoas que tenham saldo_pontos 'condicao'
             $pessoas = $pessoas->where(
                 'saldo_pontos',
                 $this->condicao_saldo_pontos,
                 $this->saldo_pontos
             );
         }
         //Caso segmentacao por data de vencimento dos pontos
         if ($this->temSegmentacaoVencimentoPontos) {
             $pessoas = $pessoas->whereBetween('data_vencimento_pontos', [
                 $this->attributes['data_vencimento_pontos_menor'],
                 $this->attributes['data_vencimento_pontos_maior']
             ]);
         }
         //Caso segmentacao por vencimento data de ultima compra
         if ($this->temSegmentacaoUltimaCompra) {
             $pessoas = $pessoas->whereBetween('data_ultima_compra', [
                 $this->attributes['data_ultima_compra_menor'],
                 $this->attributes['data_ultima_compra_maior']
             ]);
         }

        return $pessoas;
     }


     /**
      * Acessor para a quantidade de pessoas que cumprem os criterios de segmentacao
      *
      * @return integer
      */
      public function getQntPessoasAttribute()
      {
         return $this->pessoasQuery->count();
      }

}
