@extends('main')
@section('content')

<!-- Inspiro Slider -->
<div class="inspiro-slider slider-halfscreen arrows-large arrows-creative dots-creative visible-md visible-lg" data-height-xs="360"  data-height="500"  data-height-lg="300" data-autoplay-timeout="2600" data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true">
    <!-- Slide 1 -->
    @foreach ($banners as $b)
    @if($b->url)
    <a href="{{$b->url}}">
        <div class="slide background-image" style="background-size:cover; display:block; background-image:url('https://radax.pidia.com.br/imgs/radax/banners/{{ $b->id }}/{{ $b->imagem_lg }}'); background-position: center ">
            <div class="container">
               
                <div class="slide-captions text-center">
                </div>
            
            </div>
        </div>
    </a>
    @else
    <div class="slide background-image" style="background-size:cover; display:block; background-image:url('https://radax.pidia.com.br/imgs/radax/banners/{{ $b->id }}/{{ $b->imagem_lg }}'); background-position: center ">
        <div class="container">  
            <div class="slide-captions text-center">
            </div>
        </div>
    </div>
    @endif
 
    @endforeach
</div>

<!-- Inspiro Slider -->
<div class="inspiro-slider slider-halfscreen arrows-large arrows-creative dots-creative visible-sm" data-height-xs="360"  data-height="500"  data-height-lg="300" data-autoplay-timeout="2600" data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true">
    <!-- Slide 1 -->
    @foreach ($banners as $b)
    @if($b->url)
    <a href="{{$b->url}}">
    <div class="slide background-image" style="background-size:cover; display:block; background-image:url('https://radax.pidia.com.br/imgs/radax/banners/{{ $b->id }}/{{ $b->imagem_md }}'); background-position: center ">
        <div class="container">
            <div class="slide-captions text-center">
            </div>
        </div>
    </div>
</a>
@else
<div class="slide background-image" style="background-size:cover; display:block; background-image:url('https://radax.pidia.com.br/imgs/radax/banners/{{ $b->id }}/{{ $b->imagem_md }}'); background-position: center ">
    <div class="container">
        <div class="slide-captions text-center">
        </div>
    </div>
</div>
@endif
    @endforeach
</div>


<!-- Inspiro Slider -->
<div class="inspiro-slider slider-halfscreen arrows-large arrows-creative dots-creative visible-xs" data-height-xs="360"  data-height="500"  data-height-lg="300" data-autoplay-timeout="2600" data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true">
    <!-- Slide 1 -->
    @foreach ($banners as $b)
    @if($b->url)
    <a href="{{$b->url}}">
    <div class="slide background-image" style="background-size:cover; display:block; background-image:url('https://radax.pidia.com.br/imgs/radax/banners/{{ $b->id }}/{{ $b->imagem_xs }}'); background-position: center ">
        <div class="container">
            <div class="slide-captions text-center">
            </div>
        </div>
    </div>
</a>
    @else
    <div class="slide background-image" style="background-size:cover; display:block; background-image:url('https://radax.pidia.com.br/imgs/radax/banners/{{ $b->id }}/{{ $b->imagem_xs }}'); background-position: center ">
        <div class="container">
            <div class="slide-captions text-center">
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>



<!-- Shop products -->
<section id="page-content" style="margin-top:20px" class="sidebar-left">
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

                
                <!-- <div class="widget clearfix widget-newsletter">
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
                </div> -->


            </div>
            <!-- end: Sidebar-->
        </div>
    </div>
</section>
<!-- end: Shop products -->




@endsection