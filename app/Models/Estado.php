<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Estado
 * @package App\Models
 * @version January 23, 2019, 2:58 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Cidade
 * @property string nome
 * @property string sigla
 */
class Estado extends Model
{
    public $table = 'estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'sigla'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'sigla' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cidades()
    {
        return $this->hasMany(\App\Models\Cidade::class);
    }
}
