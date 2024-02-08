<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="INSPIRO" />
  <meta name="description" content="Themeforest Template Polo"> <!-- Document title -->
  <title>Radax do Brasil</title> <!-- Stylesheets & Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,800,700,600|Montserrat:400,500,600,700|Raleway:100,300,600,700,800"
    rel="stylesheet" type="text/css" />
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.min.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/app.css" rel="stylesheet">
  @stack('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F56TB7J0ZB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-F56TB7J0ZB');
</script>
</head>

<body>


  <!-- Wrapper -->
  <div id="wrapper">
    <!-- Topbar -->
    <div id="topbar" class="visible-md visible-lg">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <ul class="top-menu">
              <li><a href="#">54 3449.3699</a></li>
              <li><a href="#">radax@radax.com.br</a></li>
            </ul>
          </div>
          <div class="col-sm-6 hidden-xs">
          </div>
        </div>
      </div>
    </div>
    <!-- end: Topbar -->

    <!-- Header -->
    <header id="header">
      <div id="header-wrap">
        <div class="container">
          <!--Logo-->
          <div id="logo">
            <a href="/" class="logo" data-dark-logo="images/logo-dark.png">
              <img src="/images/logo.png" alt="Polo Logo">
            </a>
          </div>
          <!--End: Logo-->

          <!--Top Search Form-->
          <div id="top-search">
          <form action="{{route('localizar')}}" method="POST">
            @csrf
              <input type="text" name="q" class="form-control" value=""
                placeholder="Digite o código ou descrição" style="text-transform: uppercase">
            </form>
          </div>
          <!--end: Top Search Form-->

          <!--Header Extras-->
          <div class="header-extras">
            <ul>
              <li>
                <!--top search-->
                <a id="top-search-trigger" href="#" class="toggle-item">
                  <i class="fa fa-search"></i>
                  <i class="fa fa-close"></i>
                </a>
                <!--end: top search-->
              </li>
              <li>
                <!--shopping cart-->
                <div id="shopping-cart">
                <a href="{{route('orcamento')}}">
                    <span class="shopping-cart-items" id="sci">{{Cart::getTotalQuantity()}}</span>
                    <i class="fa fa-shopping-cart"></i></a>
                </div>
                <!--end: shopping cart-->
              </li>
            </ul>
          </div>
          <!--end: Header Extras-->
          <!--Navigation Resposnive Trigger-->
          <div id="mainMenu-trigger">
            <button class="lines-button x"> <span class="lines"></span> </button>
          </div>
          <!--end: Navigation Resposnive Trigger-->

          <!--Navigation-->
          <div id="mainMenu">
            <div class="container">
              <nav>
                <ul>
                  <li><a href="/">Home</a></li>
                  <li><a href="/a-radax">A Radax</a></li>
                  <li><a href="/produtos">Produtos</a></li>
                  <li class="dropdown d-none hide"> <a href="#">Produtos</a>
                    <ul class="dropdown-menu">

                      @foreach($menu_categorias as $m)
                      <li class="dropdown-submenu"><a href="#"><i class="fa fa-tags"></i>{{$m->nome}}</a>
                        <ul class="dropdown-menu">
                          @foreach($m->descendants()->limitDepth(7)->get() as $mm)
                          <li><a href="#">{{$mm->nome}}</a></li>
                          @endforeach
                        </ul>
                      </li>
                      @endforeach
                    </ul>

                  </li>
         
                  
                  <li><a href="/catalogo-virtual">Catálogo virtual</a></li>
                  <li><a href="/fale-conosco">Fale conosco</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- end: Header -->
    @yield('content')
    <!-- Footer -->
    <footer id="footer" class="footer-light">
      <div class="footer-content">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <!-- Footer widget area 1 -->
              <div class="widget  widget-contact-us"
                style="background-image: url('images/world-map-dark.png'); background-position: 50% 20px; background-repeat: no-repeat">
                <h4>Localização</h4>
                <ul class="list-icon">
                  <li><i class="fa fa-map-marker"></i> Wolsir A. Antonini, 230 Bairro Fenavinho
                    <br> Bento Gonçalves, RS, 95703-362</li>
                  <li><i class="fa fa-phone"></i> 54 3449.3699 </li>
                  <li><i class="fa fa-envelope"></i> <a href="mailto:radax@radax.com.br">radax@radax.com.br</a>
                  </li>
                  <li>
                    <br><i class="fa fa-clock-o"></i>Segunda à Sexta: <strong>07:45 - 11:35 | 13:15 - 17:50</strong>
                  </li>
                </ul>
                <!-- Social icons -->
                <!-- end: Social icons -->
              </div>
              <!-- end: Footer widget area 1 -->
            </div>
            <div class="col-md-2">
              <!-- Footer widget area 2 -->
              <div class="widget">
                <h4>Links Rápidos</h4>
                <ul class="list-icon list-icon-arrow">
                  <li><a href="/">Home</a></li>
                  <li><a href="/a-radax">A Radax</a></li>
                  <li><a href="/produtos">Produtos</a></li>
                  <li><a href="/catalogo/catalogo.pdf" target="_blank">Catálogo Virtual</a></li>
                  <li><a href="/fale-conosco">Fale Conosco</a></li>
                </ul>
              </div>
              <div class="social-icons social-icons-colored-hover">
                <ul>
                  <li class="social-whatsapp"><a href="https://wa.me/5554996625992" target="_blank"><i class="fa fa-whatsapp"></i></a></li>

                    <li class="social-facebook"><a href="https://www.facebook.com/radaxdobrasil" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-instagram"><a href="https://www.instagram.com/radaxdobrasil/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
              <!-- end: Footer widget area 2 -->
            </div>
            
          
          </div>
        </div>
      </div>
      <div class="copyright-content">
        <div class="container">
          <div class="copyright-text text-center">&copy; {{date('Y')}} Radax do Brasil. <a href="http://www.pidia.com.br" target="_blank">Agência Pídia</a> | <a href="/lgpd" target="_blank">Política LGPD</a>
          </div>
        </div>
      </div>
    </footer>
    <!-- end: Footer -->
    <div class="alert text-center cookiealert" role="alert">
      <b>Não armazenamos dados pessoais ao acessar nosso site, porém, podemos utilizar cookies nesse processo para melhorar a experência de navegação. Para mais informações, acesse nossa Política de Privacidade e Proteção de dados.  <a href="/lgpd" target="_blank">Saiba mais</a>
  
      <button type="button" class="btn btn-success btn-sm acceptcookies">
          Aceito
      </button>
  </div>


  </div>
  <a href="https://wa.me/5554996625992" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
  <script src="/js/jquery.js"></script>
  <script src="/js/plugins.js"></script>
  <script src="/js/functions.js"></script>
  <script src="/js/app.js"></script>
  <script>
    $(function() {
        $('.list-group-item').on('click', function() {
          $('.fa', this)
            .toggleClass('fa-angle-right')
            .toggleClass('fa-angle-down');
        });
      });
  </script>
  <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>

  @stack('js')
</body>

</html>