@extends('main')
@section('content')
<section id="page-title" class="page-title-center" data-parallax-speed="1"
  data-parallax-image="/images/banner-interno.jpg">
  <div class="container">
    <div class="page-title">
      <h1>Produtos</h1>
    </div>
  </div>
</section>
<div class="page-menu menu-lines">
  <div class="container">
   

    <div id="menu-responsive-icon">
      <i class="fa fa-reorder"></i>
    </div>

  </div>
</div>


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
                    <div class="col-md-3 hide">
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
                        @foreach ($destaques as $key=>$d)
                            @foreach ($d as $kkey=>$dd)
                                @foreach ($dd as $ddd)
                                <div class="grid-item">
                                    <div class="product">
                                        <div class="product-image">
                                            <a href="{{route('produto', ['categoria'=>$kkey, 'produto'=>str_replace('/','@',$ddd->codAlt), 'slug'=>str_slug($ddd->descr)])}}"><img class="cover" alt="Shop product image!" src="{{env("IMGS").$ddd->arqFoto.'.jpg'}}">
                                            </a>
                                            <span class="product-new hide">NEW</span>
                                            <span class="product-wishlist hide">
                                                <a href="#"><i class="fa fa-heart"></i></a>
                                            </span>
                                            <div class="product-overlay">
                                                <a href="{{route('produto', ['categoria'=>$kkey, 'produto'=>str_replace('/','@',$ddd->codAlt), 'slug'=>str_slug($ddd->descr)])}}">Saiba mais</a>
                                            </div>
                                        </div>
                                        <div class="product-description">
                                            <div class="product-category hide">{{$ddd->descrSubgrupo}}</div>
                                            <div class="product-title">
                                                <h3><a href="{{route('produto', ['categoria'=>$kkey, 'produto'=>str_replace('/','@',$ddd->codAlt), 'slug'=>str_slug($ddd->descr)])}}">{{$ddd->descr}}</a>
                                                </h3>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>

                    
                    <!-- end: Pagination -->
                </div>
                <!--End: Product list-->
            </div>
            <!-- end: Content-->

            <!-- Sidebar-->
            <div class="sidebar col-md-3">
                @include('partials.menu-lateral')

                @include('partials.tags')

           

            </div>
            <!-- end: Sidebar-->
        </div>
    </div>
</section>
<!-- end: Shop products -->




@endsection