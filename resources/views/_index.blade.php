@extends('main')
@section('content')

<!-- Inspiro Slider -->
<div id="slider" class="inspiro-slider slider-halfscreen arrows-large arrows-creative dots-creative" data-height-xs="360" data-autoplay-timeout="2600" data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true">
  <!-- Slide 1 -->
  <div class="slide background-overlay-dark background-image" style="background-image:url('/images/banners/interno.jpg');">
    <div class="container">
      <div class="slide-captions text-center">
        <!-- Captions -->
        <h6 class="text-light">NOSSOS PRODUTOS</h6>
        <h2 class="text-uppercase text-medium text-light">Toda linha de produtos Makita</h2>
        <p class="lead text-light">São mais de 150 produtos segmentados,
          <br /> para atender a qualquer situação.</p>
        <a class="btn btn-light" href="http://themeforest.net/item/polo-responsive-multipurpose-html5-template/13708923">Conheça a
          Linha</a>

        <!-- end: Captions -->
      </div>
    </div>

  </div>
  <!-- end: Slide 2 -->
</div>
<!--end: Inspiro Slider -->


<!-- Shop products -->
<section id="page-content" class="sidebar-left">
  <div class="container">
    <div class="row">
      <!-- Content-->
      <div class="content col-md-9">
        <div class="row m-b-20">
          <div class="col-md-9 p-t-10 m-b-20">
            <h3 class="m-b-20">Destaques de Produtos</h3>
          </div>
          <div class="col-md-3">
            <div class="order-select">
              <h6>Ordenar por</h6>
              <form method="get">
                <select>
                  <option selected="selected" value="order">Padrão</option>
                  <option value="popularity">Mais Clicados</option>
                  <option value="rating">Ordem Crescente</option>
                  <option value="rating">Ordem Decrescente</option>
                </select>
              </form>
            </div>
          </div>
        </div>

        <!--Product list-->
        <div class="shop">
          <div class="grid-layout grid-4-columns" data-item="grid-item">
            @foreach ($destaques as $d)
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
                    <a href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}">Saiba mais</a>
                  </div>
                </div>
                <div class="product-description">
                  <div class="product-category">{{$d->descrSubgrupo}}</div>
                  <div class="product-title">
                    <h3><a href="{{route('produto', ['categoria'=>$categoria->slug, 'produto'=>str_replace('/','@',$d->codAlt), 'slug'=>str_slug($d->descr)])}}">{{$d->descr}}</a>
                    </h3>
                  </div>


                </div>
              </div>
            </div>
            @endforeach
          </div>

          <hr>
          <!-- Pagination -->
          <div class="pagination">
            <ul>
              <li>
                <a href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                </a>
              </li>
              <li><a href="#">1</a> </li>
              <li><a href="#">2</a> </li>
              <li class="active"><a href="#">3</a> </li>
              <li><a href="#">4</a> </li>
              <li><a href="#">5</a> </li>
              <li>
                <a href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                </a>
              </li>
            </ul>
          </div>
          <!-- end: Pagination -->
        </div>
        <!--End: Product list-->
      </div>
      <!-- end: Content-->

      <!-- Sidebar-->
      <div class="sidebar col-md-3">
        <!--widget newsletter-->
        <div class="widget clearfix widget-archive">
          <h4 class="widget-title">Categorias de produtos</h4>


          <div class="list-group list-group-root well">
          @foreach($menu_categorias as $m)
            <a href="#menu-{{$m->id}}" class="list-group-item" data-toggle="collapse">
              <i class="fa fa-fw fa-angle-right"></i>{{$m->nome}}
            </a>
            <div class="list-group collapse" id="menu-{{$m->id}}">
            @foreach($m->descendants()->get() as $mm)
                <a href="#menu-sub-{{$m->id}}" class="list-group-item" data-toggle="collapse">
                  <i class="fa fa-fw fa-angle-right"></i>{{$mm->nome}}
                </a>
                <div class="list-group collapse" id="menu-sub-{{$mm->id}}">
                  @foreach($mm->descendants()->get() as $mmm)
                    <a href="#" class="list-group-item">{{$mmm->nome}}</a>
                  @endforeach 
                </div>
              
              

              @endforeach
            </div>
            @endforeach

          </div>



          <ul class="list list-lines" id="menu-lateral">
            @foreach($menu_categorias as $m)
            <li class="panel"> <a data-toggle="collapse" data-parent="#menu-lateral" href="#menu-{{$m->id}}">{{$m->nome}}</a>
              <ul id="menu-{{$m->id}}" class="collapse list-lines">
                @foreach($m->descendants()->limitDepth(2)->get() as $mm)
                <li><i class="fa fa-fw fa-angle-right"></i><a href="{{route('produtos', $mm->slug)}}">{{$mm->nome}}</a></li>
                @endforeach
              </ul>
            </li>
            @endforeach
          </ul>

        </div>

        <div class="widget clearfix widget-tags">
          <h4 class="widget-title">Tags</h4>
          <div class="tags">
            <a href="#">Limpeza</a>
            <a href="#">Parafusos</a>
            <a href="#">Soldas</a>
            <a href="#">Amarração</a>
            <a href="#">Makita</a>
            <a href="#">Abrasivos</a>
            <a href="#">Segurança</a>
          </div>
        </div>
        <div class="widget clearfix widget-newsletter">
          <form class="form-inline" method="get" action="#">
            <h4 class="widget-title">Receba informações e ofertas</h4>
            <small>Inscreva-se para receber ofertas e lançamentos em seu email via newsletter.</small>
            <div class="input-group">

              <input type="email" placeholder="Digite seu email" class="form-control required email" name="widget-subscribe-form-email" aria-required="true">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-paper-plane"></i></button>
              </span>
            </div>
          </form>
        </div>


      </div>
      <!-- end: Sidebar-->
    </div>
  </div>
</section>
<!-- end: Shop products -->




@endsection