<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Televenda extends Model
{
    protected $table = 'televendas';
    protected $primaryKey = 'id';

    public function cidade()
    {
        return $this->belongsTo('App\Cidade', 'cidade_id');
    }
}
