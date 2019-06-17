<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoInformacao
 * @package App\Models
 * @version May 17, 2019, 9:37 pm UTC
 *
 * @property string tipo_informacao
 */
class TipoInformacao extends Model
{
    use SoftDeletes;

    public $table = 'tipo_informacoes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_informacao'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_informacao' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_informacao' => 'required'
    ];

    
}
