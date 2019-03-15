<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Laratrust\Traits\LaratrustUserTrait;


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
class Pessoa extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use HasPushSubscriptions;
    use SoftDeletes;
    use HasApiTokens;

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
        'complemento',        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'social_token'
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
