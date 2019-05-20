<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cupon
 * @package App\Models
 * @version March 17, 2019, 9:59 pm UTC
 *
 * @property \App\Models\Oferta oferta
 * @property date data_validade
 * @property string texto_cupom
 * @property integer oferta_id
 */
class Cupon extends Model
{
    use SoftDeletes;

    public $table = 'cupons';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'data_validade',
        'texto_cupom',
        'oferta_id',
        'foto_caminho',
        'titulo',
        'subtitulo',
        'aparece_listagem',
        'qrcode'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_validade' => 'date',
        'texto_cupom' => 'string',
        'oferta_id' => 'integer',
        'foto_caminho' => 'string',
        'titulo' => 'string',
        'subtitulo' => 'string',
        'aparece_listagem' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'data_validade' => 'required',
        'texto_cupom' => 'required',
        'titulo' => 'required | max: 150',
        'subtitulo' => 'required | max: 150',
    ];

    /**
     * Scope para aplicar na query filtrando pelos cupons que estao com 'aparece_listagem' true
     * Os cupons aparecem na listagem ou não (comuns || fisicos/promocionais)
     */
     public function scopeApareceListagem($query)
     {
        return $query->where('aparece_listagem', true);
     }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function oferta()
    {
        return $this->belongsTo(\App\Models\Oferta::class, 'oferta_id', 'id');
    }

    /**
     * Relacionamento N x N entre cupons e pessoas
     *
     * @return relationship
     */
    public function pessoas()
    {
        return $this->belongsToMany('App\Models\Pessoa', 'cupons_pessoas', 'cupom_id', 'pessoa_id');
    }

    /**
     * Relação polimórfica 1 x N com fotos
     *
     * @return void
     */
    public function fotos()
    {
        return $this->morphMany(\App\Models\Foto::class, 'owner');
    }

    /**
     * Relacionamento N x N entre Cupons e Categorias (polimórfico)
     *
     * @return void 
     */
    public function categorias()
    {
        return $this->morphToMany('App\Models\Categoria', 'owner', 'segmentacoes');
    }

    /**
     * Acessor que traz a a primeira foto do cupon, caso nao exista nenhuma
     * trazer da oferta, caso eles estejam relacionados
     *
     * @return void
     */
    public function getFotoCaminhoAttribute()
    {
        if ($this->fotos()->count()) {
            return $this->fotos()->first()->urlCloudinary;
        }

        if ($this->oferta) {
            return $this->oferta->foto_oferta;
        }
    }

    /**
     * Alimenta a relação com a pessoa e com o código único gerado
     * na rota de ativação
     *
     * @return void
     */
    public function ativar($pessoa_id, $codigo_unico)
    {
        \App\Models\CuponPessoa::create([
            'cupom_id' => $this->id,
            'pessoa_id' => $pessoa_id,
            'codigo_unico' => $codigo_unico,
        ]);
    }

    /**
     * Gera um código para inserção na coluna codigo_unico
     * da tabela pivô cupons_pessoas
     *
     * @param $id_vestylle_pessoa Id da pessoa no sistema da vestylle
     *
     * @return string
     */
    public function gerarCodigoUnico($id_vestylle_pessoa)
    {
        $codigo = "#" . $id_vestylle_pessoa . '-' . $this->id;

        return $codigo;
    }    

    /**
     * Metodo para dar find a partir do idEncryptado
     *
     * @see App\Repositories\CuponRepository - findEncryptadoWithoutFail
     * @param mixed $idEncryptado
     *
     * @return void
     */
    public static function findEncryptado($idEncryptado)
    {        
        return self::where('qrcode', $idEncryptado)->get()->first();
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSegmentadosPorUsuario($query, $pessoa)
    {
        $categoriasPessoa = $pessoa->categorias->pluck('id')->toArray();

        return $query->whereHas(
            'categorias', function ($query) use ($categoriasPessoa) { 
                $query->whereIn('owner_id', $categoriasPessoa);
            }
        );        
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNaoSegmentados($query)
    {
        return $query->doesntHave('categorias');
    }

}
