<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;


class Categoria extends Node
{
    protected $table = 'categorias';
    protected $orderColumn = 'nome';
    protected $fillable = [''];
    //
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produtos_categorias')->where('ativo', 1);
    }
    public function scopeIndex($query)
    {
        return $query->with('produtos')->orderby('nome')->get();
    }
    public function scopeMenu($query)
    {
        return $query->select('id', 'nome', 'slug')->orderby('nome')->get();
    }
    static function buildCatForMenu($node)
    {
        $html = '
            <a href="#' . $node->id . '" class="list-group-item" data-toggle="collapse">
                <i class="fa fa-fw fa-angle-right"></i>' . $node->nome . '
            </a>
            <div class="list-group collapse" id="' . $node->id . '">
            ';

        if ($node->isLeaf()) {
            $html = '<a class="list-group-item" href="/produtos/' . $node->slug . '">' . $node->nome . '</a>';
        } else {
            foreach ($node->children as $child) {
                $html .= Categoria::buildCatForMenu($child);
            }
            return $html .= '</div>';
        }

        return $html;
    }

    // static function buildCatForMenu ($node)
    // {
    //     $liElement = '<li><a hre="#">'.$node->nome.'</a>';

    //     if ($node->isLeaf()) {
    //         return $liElement . '</li>';
    //     } else {
    //         $html = $liElement;

    //         $html .= '<ul>';

    //         foreach ($node->children as $child)
    //             $html .= Categoria::buildCatForMenu($child);
    //         $html .= '</ul>';

    //         $html .= '</li>';
    //     }

    //     return $html;
    // }


}
