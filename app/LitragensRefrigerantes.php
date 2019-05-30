<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LitragensRefrigerantes extends Model
{
    protected $table = 'litragens_refrigerantes';
    protected $primaryKey = 'id_litragem_refrigerante';
    protected $fillable = ['litragem_refrigerante', 'flg_ativo'];
}
