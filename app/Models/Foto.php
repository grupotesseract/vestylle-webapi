<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Foto
 * @package App\Models
 * @version March 30, 2019, 12:19 am UTC
 *
 * @property string image_name
 * @property string image_path
 * @property string image_extension
 * @property integer owner_id
 * @property string owner_type
 */
class Foto extends Model
{
    public $table = 'fotos';

    public $fillable = [
        'cloudinary_id',
        'image_name',
        'image_path',
        'image_extension',
        'owner_id',
        'owner_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image_name' => 'string',
        'image_path' => 'string',
        'image_extension' => 'string',
        'owner_id' => 'integer',
        'owner_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'file' => 'required'
    ];


    /**
     * Antes de deletar uma foto deve deletar o arquivo do cloudinary
     * Depois de deletar uma foto deve deletar também do filesystem se existir
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($foto) {
            return $foto->cloudinary_id
                ? \Cloudder::destroyImage($foto->cloudinary_id)
                : true;
        });

        static::deleted(function ($foto) {
            if (\File::exists($foto->fullPath)) {
                \File::delete($foto->fullPath);
            }
        });
    }

    /**
     * Relação polimorfica de foto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Definindo um acessor para o fullpath da foto.
     */
    public function getFullPathAttribute()
    {
        return $this->image_path.$this->image_name.'.'.$this->image_extension;
    }

    /**
     * Acessor para obter a URL o Cloudinary com formato e qualidade auto.
     */
    public function getURLCloudinaryAttribute()
    {
        return '//res.cloudinary.com/'
            .env('CLOUDINARY_CLOUD_NAME')
            .'/image/upload/f_auto,q_auto/'
            .env('CLOUDINARY_CLOUD_FOLDER', '')
            ."/$this->cloudinary_id";
    }

}
