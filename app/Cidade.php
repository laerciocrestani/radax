<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';
    protected $primaryKey = 'id';

    public function televendas()
    {
        return $this->belongsToMany('App\Televenda', 'cidades_televendas');
    }

}
