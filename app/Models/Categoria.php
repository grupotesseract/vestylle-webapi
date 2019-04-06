<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $fillable = [
        'owner_type',
        'owner_id',
        'segmentacao_id'        
    ];

    public function segmentos()
    {
        return $this->morphTo();
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function segmentacao()
    {
        return $this->belongsTo(\App\Models\Segmentacao::class);
    }
}

