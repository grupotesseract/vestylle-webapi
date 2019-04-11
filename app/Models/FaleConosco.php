<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FaleConosco
 * @package App\Models
 * @version March 21, 2019, 12:20 am UTC
 *
 * @property \App\Models\Pessoa pessoa
 * @property integer pessoa_id
 * @property string assunto
 * @property string mensagem
 * @property string contato
 */
class FaleConosco extends Model
{
    use SoftDeletes;

    public $table = 'fale_conoscos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'pessoa_id',
        'assunto',
        'mensagem',
        'contato'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'pessoa_id' => 'integer',
        'assunto' => 'string',
        'mensagem' => 'string',
        'contato' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pessoa_id' => 'integer|nullable',
        'assunto' => 'string|nullable',
        'mensagem' => 'string|nullable',
        'contato' => 'string|nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function pessoa()
    {
        return $this->hasOne(\App\Models\Pessoa::class, 'pessoa_id', 'id');
    }
}
