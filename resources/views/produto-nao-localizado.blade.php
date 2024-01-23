@extends('main')
@section('content')
<!-- Page title -->
<section id="page-title" class="page-title-center" data-parallax-speed="1"
  data-parallax-image="/images/banner-interno.jpg">
  <div class="container">
    <div class="page-title">

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
        <div class="alert alert-info">
        <h5>Produto não localizado com o código ou descrição: {{$q}}</h5>
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
          <div class="grid-layout grid-6-columns" data-item="grid-item">
            @foreach ($relacionados as $d)
            <div class="grid-item">
              <div class="product">
                <div class="product-image">
                  <a href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}"><img class="cover" alt="Shop product image!" src="{{env("IMGS").$d->arqFoto.'.jpg'}}">
                  </a>
                  <span class="product-new hide">NEW</span>
                  <span class="product-wishlist hide">
                    <a href="#"><i class="fa fa-heart"></i></a>
                  </span>
                  <div class="product-overlay">
                    <a href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}" data-lightbox="ajax">Saiba mais</a>
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