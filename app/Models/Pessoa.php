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

    // FLAG cadastro para indicar quando a pessoa completou o cadastro || se o cadastro ainda está pendente
    const CADASTRO_PENDENTE = 1;
    const CADASTRO_OK = 2;

    public $table = 'pessoas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_vestylle',
        'saldo_pontos',
        'status_cadastro',
        'celular',
        'cidade_id',
        'telefone_fixo',
        'nome',
        'cpf',
        'email',
        'endereco',
        'bairro',
        'data_ultima_compra',
        'data_vencimento_pontos',
        'data_ultima_compra',
        'complemento',
        'social_token',
        'genero'
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
        'complemento' => 'string',
        'genero' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|unique:pessoas',
        'cpf' => 'unique:pessoas',
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

    /**
     * Relacionamento N x N entre cupons e pessoas
     *
     * @return relationship
     */
    public function cupons()
    {
        return $this->belongsToMany('App\Models\Cupon', 'cupons_pessoas', 'pessoa_id', 'cupom_id');
    }

    /**
     * Relacionamento N x N entre ofertas e pessoas
     *
     * @return relationship
     */
    public function listaDesejos()
    {
        return $this->belongsToMany('App\Models\Oferta', 'lista_desejos', 'pessoa_id', 'oferta_id');
    }

    /**
     * Método para alimentar tabela pivô cupons_pessoas
     * com cupons marcados pra primeiro login associando o usuário novo
     *
     * @return void
     */
    public function associarCuponsDePrimeiroLogin()
    {
        $cuponsDePrimeiroLogin = Cupon::primeiroLogin()->pluck('id')->all();

        return $this->cupons()->sync($cuponsDePrimeiroLogin);
    }
}
