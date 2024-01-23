<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id_produto';

    protected $fillable = [
        'slug',
        'codAlt',
        'descr',
        'idGrupo',
        'descrGrupo',
        'idSubgrupo',
        'descrSubgrupo',
        'arqFoto',
        'descrCompl'
    ];
}
