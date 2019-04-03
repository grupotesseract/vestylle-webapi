<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Loja
 * @package App\Models
 * @version April 3, 2019, 11:35 pm UTC
 *
 * @property string nome
 * @property string cor_primaria
 * @property string cor_secundaria
 * @property string cor_terciaria
 * @property string endereco
 * @property string email
 * @property string whatsapp
 * @property string telefone
 * @property string horario_funcionamento
 */
class Loja extends Model
{
    use SoftDeletes;

    public $table = 'lojas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'cor_primaria',
        'cor_secundaria',
        'cor_terciaria',
        'endereco',
        'email',
        'whatsapp',
        'telefone',
        'horario_funcionamento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nome' => 'string',
        'cor_primaria' => 'string',
        'cor_secundaria' => 'string',
        'cor_terciaria' => 'string',
        'endereco' => 'string',
        'email' => 'string',
        'whatsapp' => 'string',
        'telefone' => 'string',
        'horario_funcionamento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'string|required',
        'cor_primaria' => 'string|nullable',
        'cor_secundaria' => 'string|nullable',
        'cor_terciaria' => 'string|nullable',
        'endereco' => 'string|nullable',
        'email' => 'email|nullable',
        'whatsapp' => 'string|nullable',
        'telefone' => 'string|nullable',
        'horario_funcionamento' => 'string|nullable'
    ];

    
}
