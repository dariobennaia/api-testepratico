<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refrigerantes extends Model
{
    protected $table = 'refrigerantes';
    protected $fillable = ['id_refrigerante','id_tipo_refrigerante','id_litragem_refrigerante','sabor','marca','valor','estoque'];
}
