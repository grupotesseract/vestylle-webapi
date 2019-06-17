<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Cidade
 * @package App\Models
 * @version January 23, 2019, 2:59 am UTC
 *
 * @property \App\Models\Estado estado
 * @property \Illuminate\Database\Eloquent\Collection Pessoa
 * @property string nome
 * @property string ibge_code
 * @property integer estado_id
 */
class Cidade extends Model
{
    public $table = 'cidades';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'ibge_code',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'ibge_code' => 'string',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pessoas()
    {
        return $this->hasMany(\App\Models\Pessoa::class);
    }
}
