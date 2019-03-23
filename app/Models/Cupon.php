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
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'data_validade' => 'required',
        'texto_cupom' => 'required',
    ];

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
     * Mutator que traz a foto da oferta no lugar da foto
     * do cupom caso eles estejam relacionados
     *
     * @return void
     */
    public function getFotoCaminhoAttribute()
    {
        if ($this->oferta) {
            return $this->oferta->foto_oferta;
        }
        return $this->attributes['foto_caminho'];
    }
}
