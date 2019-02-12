<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pessoa
 * @package App\Models
 * @version January 23, 2019, 1:40 am UTC
 *
 * @property integer id_vestylle
 * @property smallInt saldo_pontos
 * @property smallInt celular
 * @property smallInt cidade_id
 * @property smallInt telefone_fixo
 * @property string nome
 * @property string cpf
 * @property string email
 * @property string endereco
 * @property string bairro
 * @property string complemento
 */
class Pessoa extends Model
{
    use SoftDeletes;

    public $table = 'pessoas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_vestylle',
        'saldo_pontos',
        'celular',
        'cidade_id',
        'telefone_fixo',
        'nome',
        'cpf',
        'email',
        'endereco',
        'bairro',
        'complemento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_vestylle' => 'integer',
        'nome' => 'string',
        'cpf' => 'string',
        'email' => 'string',
        'endereco' => 'string',
        'bairro' => 'string',
        'complemento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'cpf' => 'required',
        'email' => 'email'
    ];

    /**
     * Relacionamento entre Pessoa x Cidade
     *
     * @return void
     */
    public function cidade()
    {
        return $this->belongsTo('App\Models\Cidade');
    }



}
