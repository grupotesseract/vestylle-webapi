<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descricao_oferta' => 'string',
        'texto_oferta' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descricao_oferta' => 'required',
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
        return $this->hasMany('App\Cupon');
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
     * Relação de polimorfica com fotos
     *
     * @return void
     */
    public function foto()
    {
        return $this->morphOne(\App\Models\Foto::class, 'owner');
    }

    /**
     * Acessor para obter a URL da foto da Oferta.
     *
     * @return string - URL da foto ou de um placeholder com tamanho equivalente
     */
    public function getUrlFotoAttribute()
    {
        return $this->foto
            ? $this->foto->urlCloudinary
                : '//via.placeholder.com/500x500';
    }
}
