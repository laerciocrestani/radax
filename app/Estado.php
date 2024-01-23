<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'id';

    public function cidades()
    {
        return $this->hasMany('App\Cidade', 'estado_id');
    }
}