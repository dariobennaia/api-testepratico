<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposRefrigerantes extends Model
{
    protected $table = 'tipos_refrigerantes';
    protected $primaryKey = 'id_tipo_refrigerante';
    protected $fillable = ['tipo_refrigerante', 'flg_ativo'];
}
