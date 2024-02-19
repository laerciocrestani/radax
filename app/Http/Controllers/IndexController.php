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
use App\Cidade;
use App\Banner;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function index()
  {


    // $fb = DB::connection('firebird')->select('* FROM s');

    // dd($fb);


    $grupos = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/grupos/' . env("API_TOKEN"))->asJson()->get();
    $menu_categorias2 = Categoria::where('ativo', 1)->get()->toHierarchy();
    $categoria = Categoria::where('id', 159)->first(); // ALICATES

    $destaques_home = Categoria::where('id', 213)->first();
    //$produtos_id = explode(',', $destaques_home->ids_grupo);
    $produtos_id = [
      'consumiveis' => 861,
      'parafusos-ponta-broca' => 795,
      'poliuretanos' => 979,
      'parafusos-ponta-ogivada' => 1077,
      'colas' => 1073
    ];

    $banners = Banner::orderby('position')->get();

    $destaques = array();
    foreach ($produtos_id as $key => $cd) {
      $produtos_collect = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $cd . '/' . env("API_TOKEN") . '?page=0&size=4')->asJson()->get();
      array_push($destaques, [$key => $produtos_collect]);
    }



    // $destaques = array();
    // foreach ($produtos_id as $key=>$cd) {
    //   $produtos_collect = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $cd . '/' . env("API_TOKEN"))->asJson()->get();
    //   array_push($destaques, $produtos_collect);
    // }
    //$destaques = Arr::flatten($destaques, 1);

    return view('index', compact('categoria', 'grupos', 'destaques', 'menu_categorias2', 'banners'));
  }
  public function all_produtos()
  {
    $grupos = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/grupos/' . env("API_TOKEN"))->asJson()->get();
    $menu_categorias2 = Categoria::where('ativo', 1)->get()->toHierarchy();
    $categoria = Categoria::where('id', 159)->first(); // ALICATES

    $destaques_home = Categoria::where('id', 213)->first();
    $produtos_id = [
      'consumiveis' => 861,
      'parafusos-ponta-broca' => 795,
      'poliuretanos' => 979,
      'parafusos-ponta-ogivada' => 1077,
      'colas' => 1073
    ];

    $destaques = array();
    foreach ($produtos_id as $key => $cd) {
      $produtos_collect = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $cd . '/' . env("API_TOKEN") . '?page=0&size=4')->asJson()->get();
      array_push($destaques, [$key => $produtos_collect]);
    }

    //$destaques = Arr::flatten($destaques);


    return view('all-produtos', compact('categoria', 'grupos', 'destaques', 'menu_categorias2'));
  }
  public function produtos(Request $request, Categoria $categoria)
  {
    dd($categoria);
    $categoria = Categoria::where('slug', $categoria)->first();
    $subgrupos = explode(',', $categoria->ids_subgrupo);
    //
    $produtos = array();
    foreach ($subgrupos as $cd) {
      $produtos_collect = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $cd . '/' . env("API_TOKEN") . '?size=500')->asJson()->get();
      array_push($produtos, $produtos_collect);
    }
    $produtos = Arr::flatten($produtos);
    //
    // Get current page form url e.x. &page=1
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    // Create a new Laravel collection from the array data
    $itemCollection = collect($produtos);

    // Define how many items we want to be visible in each page
    $perPage = 16;

    // Slice the collection to get the items to display in current page
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

    // Create our paginator and pass it to the view
    $produtos_paginados = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

    // set url path for generted links
    $produtos_paginados->setPath($request->url());
    //
    return view('produtos', compact('produtos_paginados', 'categoria'));
  }

  public function produto($categoria, $produto, $slug)
  {
    $categoria = Categoria::where('slug', $categoria)->first();
    $subgrupos = explode(',', $categoria->ids_subgrupo);
    shuffle($subgrupos);

    //
    $relacionados = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $subgrupos[0] . '/' . env("API_TOKEN") . '?page=0&size=12')->asJson()->get();
    //
    $produto = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produto/' . env("API_TOKEN") . '?codAlt=' . str_replace('@', '/', $produto))->asJson()->get();

    return view('produto', compact('produto', 'categoria', 'relacionados'));
  }

  public function localizar(Request $request)
  {
    $q = $request->q;
    // dd('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/descr/' . env("API_TOKEN") . '?descr=' . $q);
    $produtos = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/descr/' . env("API_TOKEN") . '?descr=' . $q)->asJson()->get();
    $produto = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produto/' . env("API_TOKEN") . '?codAlt=' . strtoupper($q))->asJson()->get();

    //
    if ($produtos) {
      return view('localizar', compact('produtos'));
    } else if ($produto) {
      $categoria = Categoria::where('ids_subgrupo', 'like', "%$produto->idSubgrupo%")->first();
      $subgrupos = explode(',', $categoria->ids_subgrupo);
      shuffle($subgrupos);
      $relacionados = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produtos/subgrupo/' . $subgrupos[0] . '/' . env("API_TOKEN") . '?page=0&size=12')->asJson()->get();
      return view('produto', compact('produto', 'categoria', 'relacionados'));
    } else {
      return view('produto-nao-localizado', compact('q'));
    }
  }
  public function orcamento()
  {
    $cart = Cart::getContent();
    $cidades = Cidade::selectRaw("id, concat(nome, ' - RS') as nome")->where('estado_id', 21)->orderby('nome', 'ASC')->pluck('nome', 'id')->prepend('Selecione', '');
    return view('orcamento', compact('cart', 'cidades'));
  }

  public function orcamento_add($categoria, $codalt)
  {
    $produto = Curl::to('https://vendasradax.sa.ngrok.io/api/v1/site/produto/' . env("API_TOKEN") . '?codAlt=' . str_replace('@', '/', $codalt))->asJson()->get();
    Cart::add([
      'id' => $produto->codAlt, // inique row ID
      'name' => $produto->descr,
      'price' => 0,
      'quantity' => 1,
      'attributes' => [
        'imagem' => $produto->arqFoto,
        'categoria' => $produto->descrSubgrupo,
        'categoria_slug' => $categoria,
      ]
    ]);
    return response()->json([
      'cart_itens' => Cart::getTotalQuantity()
    ], 200);
  }

  public function orcamento_atualizar($codalt, $qtd)
  {
    Cart::update(str_replace('@', '/', $codalt), [
      'quantity' => array(
        'relative' => false,
        'value' => $qtd
      ),
    ]);
    return response()->json([
      'cart_itens' => Cart::getTotalQuantity()
    ], 200);
  }

  public function orcamento_remover($codalt)
  {
    Cart::remove(str_replace('@', '/', $codalt));
    return redirect('orcamento');
  }
  public function orcamento_enviar(Request $request)
  {

    if ($captcha = $request->input('g-recaptcha-response')) {
      $secret = '6Le706kZAAAAADRTgdfu6opvv1VrEhVMzPR1Dz43';
      $response = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
      );

      $response = json_decode($response);

      if ($response->success === false) {
        $response = array('response' => 'error', 'message' => 'Erro ao validar dados, atualize a página e tente novamente.');
        return json_encode($response);
      }
    } else {
      $response = array('response' => 'error', 'message' => 'Erro ao validar dados, atualize a página e tente novamente.');
      return json_encode($response);
    }

    $cidade = Cidade::find($request->cidade_id);

    $email = 'radax@radax.com.br';
    if ($televenda = $cidade->televendas()->first()) {
      $email = $televenda->email;
    }

    //$email = 'laercio@pidia.com.br';

    $data = [
      'nome' => $request->nome,
      'email' => $request->email,
      'fone' => $request->fone,
      'cpf_cnpj' => $request->cpf_cnpj,
      'observacoes' => $request->observacoes,
      'carrinho' => $cart = Cart::getContent()
    ];


    Mail::send('emails.orcamentos', $data, function ($message) use ($email) {
      $message->to($email)->subject('Orçamento - Radax.com.br');
    });

    Cart::clear();

    return response()->json([
      'response' => 'success'
    ], 200);
  }
}
