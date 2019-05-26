<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function GuzzleHttp\Psr7\str;

/**
 * Class Oferta
 * @package App\Models
 * @version March 17, 2019, 7:58 pm UTC
 *
 * @property string descricao_oferta
 * @property string foto_oferta
 */
class Oferta extends Model
{
    use SoftDeletes;

    public $table = 'ofertas';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'descricao_oferta',
        'texto_oferta',
        'foto_oferta',
        'titulo',
        'subtitulo',
        'porcentagem_off',
        'codigo_promocional'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descricao_oferta' => 'string',
        'texto_oferta' => 'string',
        'foto_oferta' => 'string',
        'titulo' => 'string',
        'subtitulo' => 'string',
        'codigo_promocional' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descricao_oferta' => 'required',
        'titulo' => 'required | max: 150',
        'subtitulo' => 'required | max: 150',
    ];

    public $appends = [
        'urlFoto'
    ];


    /**
     * Relacionamento 1-N entre ofertas-cupons
     *
     * @return void
     */
    public function cupons()
    {
        return $this->hasMany('App\Models\Cupon');
    }

    /**
     * Relacionamento N x N entre ofertas e pessoas
     *
     * @return relationship
     */
    public function pessoas()
    {
        return $this->belongsToMany('App\Models\Pessoa', 'lista_desejos', 'oferta_id', 'pessoa_id');
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
     * Relacionamento N x N entre Ofertas e Categorias (polimórfico)
     *
     * @return void
     */
    public function categorias()
    {
        return $this->morphToMany('App\Models\Categoria', 'owner', 'segmentacoes');
    }



    /**
     * Acessor para obter a URL da foto da Oferta.
     *
     * @return string - URL da foto ou de um placeholder com tamanho equivalente
     */
    public function getUrlFotoAttribute()
    {
        return $this->fotos()->orderBy('updated_at', 'desc')->first()
            ? $this->fotos()->orderBy('updated_at', 'desc')->first()->urlCloudinary
                : '//via.placeholder.com/500x500';
    }

    /*
     * Mutator para obter o preço da oferta
     *
     * @return string
     */
    public function getPrecoAttribute()
    {
        return number_format($this->attributes['preco'], 2, ',', '.');
    }

    public function setPrecoAttribute($value)
    {
        $this->attributes['preco'] = str_replace(',', '.', $value);
    }

    /**
     * Scope pra trazer listagem segmentada com base nas categorias da pessoa
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSegmentadosPorUsuario($query, $pessoa)
    {
        $categoriasPessoa = $pessoa->categorias->pluck('id')->toArray();

        return $query->whereHas(
            'categorias', function ($query) use ($categoriasPessoa) {
                $query->whereIn('categoria_id', $categoriasPessoa);
            }
        );
    }

    /**
     * Scope pra trazer listagem sem segmentação
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNaoSegmentados($query)
    {
        return $query->doesntHave('categorias');
    }

}
