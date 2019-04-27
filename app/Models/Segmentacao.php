<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segmentacao extends Model
{   
    
    public $fillable = [
        'owner_type',
        'owner_id',
        'categoria_id'        
    ];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'segmentacoes';

     public function categorias()
    {
        return $this->morphTo();
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

}
