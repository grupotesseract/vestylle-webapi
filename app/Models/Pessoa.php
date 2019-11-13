<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Laratrust\Traits\LaratrustUserTrait;
use App\Notifications\ResetPassword;


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

    use HasApiTokens;

    // FLAG cadastro para indicar quando a pessoa completou o cadastro || se o cadastro ainda está pendente
    const CADASTRO_PENDENTE = 1;
    const CADASTRO_OK = 2;
    const TABELA_PERMISSOES_EXPO_PUSH = 'exponent_push_notification_interests';

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
        'data_nascimento',
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


    public $appends = [
        'permitePushs'
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
     * Relacionamento N x N entre Pessoas e Categorias (polimórfico)
     */
    public function categorias()
    {
        return $this->morphToMany('App\Models\Categoria', 'owner', 'segmentacoes');
    }

    /**
     * Relacionamento N x N entre cupons e pessoas
     *
     * @return relationship
     */
    public function faleConoscos()
    {
        return $this->hasMany('App\Models\FaleConosco');
    }

    /**
     * Mutator para a dataNascimento
     */
    public function setDataNascimentoAttribute($value)
    {
        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_nascimento'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_nascimento'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Relacao de Pessoa com a tabela que guarda as chaves identificando
     * os devices permitidos receber WebPushs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function permissoesWebPush()
    {
        return $this->hasMany(\App\Models\PessoaPush::class, 'pessoa_id');
    }

    /**
     * Acessor para determinar se essa Pessoa permitiu as notificacoes web
     *
     * @return boolean
     */
     public function getPermiteWebPushAttribute()
     {
        return $this->permissoesWebPush()->count() ? true : false;
     }


    /**
     * Metodo para obter os regisros de permissao de pushs do expo dessa pessoa
     *
     * @return QueryBuilder
     */
    public function permissoesExpoPush()
    {
        return \DB::table(self::TABELA_PERMISSOES_EXPO_PUSH)
            ->where('key', 'like', "%$this->id%");
    }

    /**
     * Acessor para determinar se essa Pessoa permitiu as notificacoes do expo
     *
     * @return boolean
     */
     public function getPermiteExpoPushAttribute()
     {
         return $this->permissoesExpoPush()->count() ? true : false;
     }

    /**
     * Acessor para determinar se a pesssoa permitiu o recebimento de pushs
     *
     * @return boolean
     */
     public function getPermitePushsAttribute()
     {
        return ($this->permiteExpoPush || $this->permiteWebPush) ? true : false;
     }


}
