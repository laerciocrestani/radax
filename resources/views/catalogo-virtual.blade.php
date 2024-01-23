@extends('main')
@section('content')
    <section id="page-title" class="page-title-center" data-parallax-speed="1" data-parallax-image="/images/banner-interno.jpg">
        <div class="container">
            <div class="page-title">
                <h1>Catálogo Virtual</h1>
            </div>
        </div>
    </section>

    <!-- Shop products -->
    <section id="page-content">
        <div class="container">
            <div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="20">
                @foreach (App\Catalogo::orderby('ordem')->get() as $cat)
                    <div class="portfolio-item img-zoom">
                        <div class="portfolio-item-wrap">
                            <div class="portfolio-image">
                                <a href="#"><img
                                        src="http://radax.pidia.com.br/imgs/radax/catalogos/{{ $cat->id }}/{{ $cat->imagem }}"
                                        alt=""></a>
                            </div>
                            <div class="portfolio-description">
                                <a title="" data-lightbox="image"
                                    href="http://radax.pidia.com.br/imgs/radax/catalogos/{{ $cat->id }}/{{ $cat->imagem }}"><i
                                        class="fa fa-expand"></i></a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
