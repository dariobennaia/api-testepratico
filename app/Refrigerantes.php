<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refrigerantes extends Model
{
    use SoftDeletes;

    protected $table = 'refrigerantes';
    protected $primaryKey = 'id_refrigerante';
    protected $fillable = [
        'id_tipo_refrigerante',
        'id_litragem_refrigerante',
        'sabor',
        'marca',
        'valor',
        'estoque'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoRefrigerante()
    {
        return $this->hasOne(
            'App\TiposRefrigerantes',
            'id_tipo_refrigerante',
            'id_tipo_refrigerante'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function litragemRefrigerante()
    {
        return $this->hasOne(
            'App\LitragensRefrigerantes',
            'id_litragem_refrigerante',
            'id_litragem_refrigerante'
        );
    }
}
