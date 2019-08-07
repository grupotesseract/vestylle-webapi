<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cupon
 * @package App\Models
 * @version March 17, 2019, 9:59 pm UTC
 *
 * @property \App\Models\Oferta oferta
 * @property date data_validade
 * @property string texto_cupom
 * @property integer oferta_id
 */
class Cupon extends Model
{
    use SoftDeletes;

    public $table = 'cupons';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'data_validade',
        'texto_cupom',
        'oferta_id',
        'foto_caminho',
        'titulo',
        'codigo_amigavel',
        'subtitulo',
        'aparece_listagem',
        'porcentagem_off',
        'qrcode'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_validade' => 'date',
        'texto_cupom' => 'string',
        'oferta_id' => 'integer',
        'foto_caminho' => 'string',
        'titulo' => 'string',
        'subtitulo' => 'string',
        'aparece_listagem' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required | max: 150',
        'subtitulo' => 'required | max: 150',
        'data_validade' => 'required',
        'texto_cupom' => 'required',
    ];

    public static $msgValidacaoAmigavel = [
        'codigo_amigavel.required_without' => 'O campo Código para ativação do cupom é obrigatório se o cupom não estiver marcado como Disponivel em "Meus Cupons"',
        'codigo_amigavel.unique' => 'O valor do campo Código para ativação do cupom já está sendo utiizado por outro cupom',
    ];

    public $appends = [
        'em_destaque',
        'fotos_listagem'
    ];

    /**
     * Método para dar override em eventos como a deleção do cupom
     * sem ter que replicar a lógica pela API quando esses eventos acontecerem
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($cupon) {
            $cupon->deletarFotosRelacionadas();
            $cupon->deletarRelacaoComPessoas();
        });
    }

    /**
     * Remove fotos do cupom do banco
     *
     * @return void
     */
    public function deletarFotosRelacionadas()
    {
        if ($this->fotos) {
            $this->fotos()->delete();
        }
    }

    /**
     * Remove registros de cupons_pessoas apontando pro cupom
     *
     * @return void
     */
    public function deletarRelacaoComPessoas()
    {
        if ($this->pessoas) {
            \DB::statement("DELETE FROM cupons_pessoas WHERE cupom_id = $this->id");
        }
    }


    /**
     * Scope para aplicar na query filtrando pelos cupons que estao com 'aparece_listagem' true
     * Os cupons aparecem na listagem ou não (comuns || fisicos/promocionais)
     */
    public function scopeApareceListagem($query)
    {
        return $query->where('aparece_listagem', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function oferta()
    {
        return $this->belongsTo(\App\Models\Oferta::class, 'oferta_id', 'id');
    }

    /**
     * Relacionamento N x N entre cupons e pessoas
     *
     * @return relationship
     */
    public function pessoas()
    {
        return $this
            ->belongsToMany('App\Models\Pessoa', 'cupons_pessoas', 'cupom_id', 'pessoa_id')
            ->withPivot('cupom_utilizado_venda', 'codigo_unico', 'data_expiracao');
    }

    /**
     * Relação polimórfica 1 x N com fotos
     *
     * @return void
     */
    public function fotos()
    {
        return $this->morphMany(\App\Models\Foto::class, 'owner');
    }

    /**
     * Foto de destaque do cupom (query)
     *
     * @return QueryBuilder
     */
    public function fotoDestaque()
    {
        return $this->fotos()
                    ->where('tipo', \App\Models\Foto::TIPO_DESTAQUE_CUPOM);
    }

    /**
     * Acessor para a foto de destaque do cupom
     *
     * @return void
     */
    public function getFotoDestaqueAttribute()
    {
        return $this->fotoDestaque()->first();
    }

    /**
     * Relacionamento N x N entre Cupons e Categorias (polimórfico)
     *
     * @return void
     */
    public function categorias()
    {
        return $this->morphToMany('App\Models\Categoria', 'owner', 'segmentacoes');
    }

    /**
     * Acessor que traz a foto de destaque do cupon, caso nao exista nenhuma
     * trazer da oferta, caso eles estejam relacionados
     *
     * @return void
     */
    public function getFotoCaminhoAttribute()
    {
        if ($this->fotoDestaque()->count()) {
            return $this->fotoDestaque->urlCloudinary;
        }

        if ($this->oferta) {
            return $this->oferta->foto_oferta;
        }
    }

    /**
     * Alimenta a relação com a pessoa e com o código único gerado
     * na rota de ativação
     *
     * @return void
     */
    public function ativar($pessoa_id, $codigo_unico)
    {
        $data_expiracao = \Carbon\Carbon::now()->addDays(7);

        return \App\Models\CuponPessoa::create([
            'cupom_id' => $this->id,
            'pessoa_id' => $pessoa_id,
            'codigo_unico' => $codigo_unico,
            'data_expiracao' => $data_expiracao
        ]);
    }

    /**
     * Gera um código para inserção na coluna codigo_unico
     * da tabela pivô cupons_pessoas
     *
     * @param $id_vestylle_pessoa Id da pessoa no sistema da vestylle
     *
     * @return string
     */
    public function gerarCodigoUnico($id_vestylle_pessoa)
    {
        $codigo = "#" . $id_vestylle_pessoa . '-' . $this->id;

        return $codigo;
    }

    /**
     * Metodo para dar find a partir do idEncryptado
     *
     * @see App\Repositories\CuponRepository - findEncryptadoWithoutFail
     * @param mixed $idEncryptado
     *
     * @return void
     */
    public static function findEncryptado($idEncryptado)
    {
        $cupon = self::where('qrcode', $idEncryptado)->first();
        return $cupon;
    }

    /**
     * Metodo para dar find a partir do codigo_amigavel
     *
     * @see App\Repositories\CuponRepository - findByCodigoAmigavel
     * @param mixed codigoAmigavel
     *
     * @return void
     */
    public static function findByCodigoAmigavel($codigoAmigavel)
    {
        $cupon = self::where('codigo_amigavel', $codigoAmigavel)->first();
        return $cupon;
    }

    /**
     * Scope pra trazer listagem segmentada com base nas categorias da pessoa
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSegmentadosPorUsuario($query, $pessoa)
    {
        $categoriasPessoa = $pessoa->categorias->pluck('id')->toArray();

        return $query->whereHas(
            'categorias', function ($query) use ($categoriasPessoa) {
                $query->whereIn('categoria_id', $categoriasPessoa);
            }
        );
    }

    /**
     * Scope pra trazer listagem sem segmentação
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNaoSegmentados($query)
    {
        return $query->doesntHave('categorias');
    }

    /**
     * Scope para filtrar cupons com data de vencimento expirada
     */
    public function scopeVencidos($query)
    {
        $now = \Carbon\Carbon::now();

        return $query->where('data_validade', '<', $now);
    }

    /**
     * Scope para filtrar cupons com data de vencimento expirada
     */
    public function scopeNaoVencidos($query)
    {
        $now = \Carbon\Carbon::now();

        return $query->where('data_validade', '>=', $now);
    }

    /**
     * Scope para filtrar cupons com data de expiracao antiga (pessoa ativou cupon a + de 7 dias)
     */
    public function scopeExpirados($query, $pessoa)
    {
        $now = \Carbon\Carbon::now();
        $pessoaId = $pessoa->id;

        return $query->whereHas('pessoas', function($qCuponPessoa) use ($pessoaId, $now) {
            $qCuponPessoa->where('pessoa_id', $pessoaId);
            $qCuponPessoa->where('data_expiracao', '<', $now);
        });
    }

    /**
     * Scope para filtrar os cupons que não foram expirados (pessoa ativou em menos de 7 dias)
     */
    public function scopeNaoExpirados($query, $pessoa)
    {
        $now = \Carbon\Carbon::now();
        $pessoaId = $pessoa->id;

        return $query->whereHas('pessoas', function($qCuponPessoa) use ($pessoaId, $now) {
            $qCuponPessoa->where('pessoa_id', $pessoaId);
            $qCuponPessoa->where('data_expiracao', '>=', $now);
        });
    }

    /**
     * Scope para aplicar na query filtrando por cupons que foram utilizados pela $pessoa
     */
    public function scopeUtilizadoVenda($query, $pessoa)
    {
        $pessoaId = $pessoa->id;
        return $query->whereHas('pessoas', function($qCuponPessoa) use ($pessoaId) {
            $qCuponPessoa->where('pessoa_id', $pessoaId);
            $qCuponPessoa->where('cupom_utilizado_venda', true);
        });
    }

    /**
     * Scope para aplicar na query filtrando por cupons que não foram utilizados pela $pessoa
     */
    public function scopeNaoUtilizadoVenda($query, $pessoa)
    {
        $pessoaId = $pessoa->id;
        return $query->whereHas('pessoas', function($qCuponPessoa) use ($pessoaId) {
            $qCuponPessoa->where('pessoa_id', $pessoaId);
            $qCuponPessoa->where('cupom_utilizado_venda', false);
            $qCuponPessoa->where('data_expiracao', '>=', \Carbon\Carbon::now());
        });
    }

    /**
     * Mutator para a data_validade
     *
     * @param mixed $value - Valor antes de inserir no BD
     */
    public function setDataValidadeAttribute($value)
    {
        if (is_null($value)) {
            return $this->attributes['data_validade'] = $value;
        }

        $isCarbon = is_object($value);

        if ($isCarbon) {
            return $this->attributes['data_validade'] = $value->format('Y-m-d');
        }

        $dataFormatada = preg_match('/\//', $value);
        return $this->attributes['data_validade'] = $dataFormatada
            ? \Carbon\Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d')
            : $value;
    }

    /**
     * Acessor para a url da foto em destaque do cupom
     */
    public function getUrlFotoDestaqueAttribute()
    {
        return $this->fotoDestaque
            ? $this->fotoDestaque->urlCloudinary
            : null;
    }

    /**
     * Acessor para determinar se esse cupom está em destaque
     */
    public function getEmDestaqueAttribute()
    {
        return $this->fotoDestaque()->count() ? true : false;
    }

    /**
     * Acessor para as Fotos que não são a foto em destaque
     */
    public function getFotosListagemAttribute()
    {
        return $this->fotos()->whereNull('tipo')->get();
    }

    /**
     * Mutator para não setar '' em um campo unique e nullable
     */
    public function setCodigoAmigavelAttribute($value)
    {
        //Se vier vazio, setar value pra null
        if (!strlen($value)) {
            $value = null;
        }

        $this->attributes['codigo_amigavel'] = $value;
    }

}
