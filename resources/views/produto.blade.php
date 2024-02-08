@extends('main')
@section('content')
<!-- Page title -->
<section id="page-title" class="page-title-center" data-parallax-speed="1"
  data-parallax-image="/images/banner-interno.jpg">
  <div class="container">
    <div class="page-title">
      <h1>
        @if(isset($categoria))
        {{$categoria->nome}}
        @else
        {{$produto->codAlt}}
        @endif
      </h1>
    </div>
  </div>
</section>

<div class="page-menu menu-lines">
  <div class="container">
    <div class="menu-title">Produto <span>Radax</span></div>


    <div id="menu-responsive-icon">
      <i class="fa fa-reorder"></i>
    </div>

  </div>
</div>

<section id="product-page" class="product-page p-b-0">
  <div class="container">
    <div class="product">
      <div class="row m-b-40">
        <div class="col-md-5 text-center">
          <!-- Carousel slider -->
          @if($produto->arqFoto)
          <a href="{{env("IMGS").$produto->arqFoto.'.jpg'}}" data-lightbox="image" title="{{$produto->descr}}">
            <img alt="{{$produto->descr}}" class="img-responsive" src="{{env("IMGS").$produto->arqFoto.'.jpg'}}" />
          </a>
          @else


          @endif
          <!-- Carousel slider -->
        </div>
        <div class="col-md-7">
          <div class="product-description">
            @if(isset($categoria))
            <div class="product-category text-left hide">{{$categoria->nome}}</div>
            @endif
            <div class="text-left product-title" style="margin-bottom:20px">
              <h3 class="text-left"><a href="#" style="font-size: 16px;">{{$produto->descr}}</a></h3>
            </div>
            <div class="product-price" style="font-size: 12px"><ins>Cod. {{$produto->codAlt}}</ins>
            </div>
            @if(isset($categoria))
            <div class="product-reviews"><a href="#">em {{$categoria->nome}}</a>
            </div>
            @endif

            <div class="seperator m-b-10"></div>
            @if($produto->descrCompl)
            <p>{{$produto->descrCompl}}</p>
            @else
            <p>Sem observações.</p>
            @endif


            <div class="seperator m-t-20 m-b-10"></div>
            <div class="row">

              <div class="col-md-12">
                <h6>Adicionar ao orçamento</h6>
                <a class="btn carrinho-add"
                  href="{{route('orcamento-add', ['codalt' =>str_replace('/', '@', $produto->codAlt), 'categoria'=> $categoria->slug])}}"><i
                    class="fa fa-shopping-cart"></i> Adicionar produto</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@if(isset($relacionados))
<section class="p-t-0">
  <div class="container">
    <div class="heading-fancy heading-line text-center">
      <h4>Produtos Relacionados</h4>
    </div>
    <div class="row">
      <div class="shop">
        <div class="grid-layout grid-6-columns hidden-xs" data-item="grid-item">
          @foreach ($relacionados as $d)
          <div class="grid-item">
            <div class="product">
              <div class="product-image">
                <a
                  href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}">
                  @if($d->arqFoto != '')
                  <img class="cover" alt="Shop product image!" src="{{env("IMGS").$d->arqFoto.'.jpg'}}">
                  @else
                  <img class="cover" alt="Shop product image!" src="/images/produto-sem-imagem-p.gif">
                  @endif
                </a>
                <span class="product-new hide">NEW</span>
                <span class="product-wishlist hide">
                  <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                  <a href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}"
                    >Saiba mais</a>
                </div>
              </div>
              <div class="product-description">
                <div class="product-category">{{$d->descrSubgrupo}}</div>
                <div class="product-title">
                  <h3><a
                      href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}">{{$d->descr}}</a>
                  </h3>
                </div>

              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="grid-layout grid-2-columns visible-xs" data-item="grid-item">
          @foreach ($relacionados as $d)
          <div class="grid-item">
            <div class="product">
              <div class="product-image">
                <a
                  href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}">
                  @if($d->arqFoto != '')
                  <img class="cover" alt="Shop product image!" src="{{env("IMGS").$d->arqFoto.'.jpg'}}">
                  @else
                  <img class="cover" alt="Shop product image!" src="/images/produto-sem-imagem-p.gif">
                  @endif
                </a>
                <span class="product-new hide">NEW</span>
                <span class="product-wishlist hide">
                  <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                  <a href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}"
                   >Saiba mais</a>
                </div>
              </div>
              <div class="product-description">
                <div class="product-category">{{$d->descrSubgrupo}}</div>
                <div class="product-title">
                  <h3><a
                      href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}">{{$d->descr}}</a>
                  </h3>
                </div>

              </div>
            </div>
          </div>
          @endforeach
        </div>
        <!-- end: Pagination -->
      </div>

    </div>
  </div>
</section>
@endif
@endsection

@push('js')
<script type="text/javascript">
  $(function(){
  $('.carrinho-add').on('click', function (e){
    var button = $('a.carrinho-add'),
      buttonText = button.html();

  button.attr('disabled', true).html('<i class="fa fa-refresh fa-spin"></i> Adicionando...');
    e.preventDefault();
        _url = $(this).attr('href');
        $.get(_url, function(data, status){
          $.notify({
              message: 'Produto adicionado ao Orçamento.'
          }, {
              type: 'success',
              offset: {
                x: 10,
                y: 91
              },
          });
          $('#sci').html(data.cart_itens);
          button.attr('disabled', false).html(buttonText);
      });
      
    });
  });
</script>
@endpush