<?php

use Symfony\Component\Routing\Route;

function renderNode($node)
{

    $html = '';

    if ($node->isLeaf()) {
        $html .= '
        <a href="'.route('produtos', $node->slug).'" class="list-group-item">
            <i class="fa fa-fw fa-dot-circle-o"></i>' . $node->nome . '
        </a>
        ';
    } else {
        $html .= '
            <a href="#menu-' . $node->id . '" class="list-group-item" data-toggle="collapse">
                <i class="fa fa-fw fa-angle-right"></i>' . $node->nome . '
            </a>
            ';
        $html .= '<div class="list-group collapse" id="menu-' . $node->id . '">';
        foreach ($node->children as $child)
            $html .= renderNode($child);


        $html .= '</div>';
    }



    return $html;
}