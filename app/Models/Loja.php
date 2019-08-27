<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Loja
 * @package App\Models
 * @version April 3, 2019, 11:35 pm UTC
 *
 * @property string endereco
 * @property string email
 * @property string whatsapp
 * @property string whatsapp2
 * @property string telefone
 */
class Loja extends Model
{
    use SoftDeletes;

    public $table = 'lojas';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'endereco',
        'email',
        'whatsapp',
        'whatsapp2',
        'dias_expiracao_cupom',
        'telefone',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'endereco' => 'string',
        'email' => 'string',
        'whatsapp' => 'string',
        'whatsapp2' => 'string',
        'telefone' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'endereco' => 'string|nullable',
        'email' => 'email|nullable',
        'whatsapp' => 'string|nullable',
        'whatsapp2' => 'string|nullable',
        'telefone' => 'string|nullable',
    ];

    /**
     * Relação polimórfica 1 x N com fotos
     *
     * @return void
     */
    public function fotos()
    {
        return $this->morphMany(\App\Models\Foto::class, 'owner');
    }
}
