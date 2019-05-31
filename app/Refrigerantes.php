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
}
