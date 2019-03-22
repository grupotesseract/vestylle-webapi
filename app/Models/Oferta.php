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
        'foto_oferta'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descricao_oferta' => 'string',
        'texto_oferta' => 'string',
        'foto_oferta' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descricao_oferta' => 'required',
        'foto_oferta' => 'required | mimes:jpg,jpeg,png',
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
}
