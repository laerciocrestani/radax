<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Curl;
use App\Categoria;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Cidade;
use App\Banner;
use App\Produto;

class ImportacaoController extends Controller
{
  public function produtos()
  {
    $leafCategories = Categoria::where('ativo', 1)->get();

    //$leafCategories = Categoria::get();

    foreach ($leafCategories as $categoria) {
      echo '<pre>';
      if($categoria->isLeaf()){
        echo $categoria->id .' - '.$categoria->nome .'<br>';
        $subgrupos = explode(',', $categoria->ids_subgrupo);
        $produtos = array();
        foreach ($subgrupos as $cd) {
          echo $cd.'<br>';
          $produtos_collect = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $cd . '/' . env("API_TOKEN") . '?size=1')->asJson()->get();
          array_push($produtos, $produtos_collect);
        }
        //$produtos = Arr::flatten($produtos);

        dd($produtos);

        foreach($produtos as $produto){
          if(!Produto::where('codAlt', $produto->codAlt)->first()){
            $produto = [
              'codAlt' => $produto->codAlt,
              'descr' => $produto->descr,
              'idGrupo' => $produto->idGrupo,
              'descrGrupo' => $produto->descrGrupo,
              'idSubgrupo' => $produto->idSubgrupo,
              'descrSubgrupo' => $produto->descrSubgrupo,
              'arqFoto' => $produto->arqFoto,
              'descrCompl' => $produto->descrCompl,
              'slug' => Str::slug($produto->descr)
            ];
            $produto = $categoria->produtos()->create($produto);
          }
          break;
        }

        dd($produtos);
      



      }
    }
      
  }
}
