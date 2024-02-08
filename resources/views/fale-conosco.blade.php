@extends('main')
@section('content')

<section id="page-title" class="page-title-center" data-parallax-speed="1"
  data-parallax-image="/images/banner-interno.jpg">
  <div class="container">
    <div class="page-title">
      <h1>Fale Conosco</h1>
    </div>
  </div>
</section>



<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h3 class="text-uppercase">Quem somos</h3>
        <p>Estamos entre as maiores distribuidoras em produtos de fixação e manutenção do estado do Rio Grande do Sul.</p>
        <p>Nossa sede em Bento Gonçalves conta com uma área de 1.200 m2 e possui diversas linhas de produtos para atender o mercado, com mais de 30.000 itens.</p>
        <div class="m-t-30">
          <form class="widget-contact-form" novalidate action="include/contact-form.php" role="form" method="post">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" aria-required="true" name="widget-contact-form-name" required
                  class="form-control required name">
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" aria-required="true" name="widget-contact-form-email" required
                  class="form-control required email">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="subject">Assunto</label>
                <input type="text" name="widget-contact-form-subject" required class="form-control required"
                  >
              </div>
            </div>
            <div class="form-group">
              <label for="message">Mensagem</label>
              <textarea type="text" name="widget-contact-form-message" required rows="5" class="form-control required">
               </textarea>
            </div>
            <!--  <div class="form-group">
                                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                    <div class="g-recaptcha" data-sitekey="6LddCxAUAAAAAKOg0-U6IprqOZ7vTfiMNSyQT2-M"></div>
                                </div>  -->
            <button class="btn" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp; Enviar
              message</button>
          </form>
        </div>
      </div>
      <div class="col-lg-6">
        <h3 class="text-uppercase">Endereço</h3>
        <div class="row">
          <div class="col-lg-12">
            <address>
              <strong>Radax do Brasil</strong><br>
              Wolsir A. Antonini, 230 Bairro Fenavinho<br>
              Bento Gonçalves, RS, 95703-362<br>
              <strong>Fone: 54 3449.3699</strong> 
            </address>
          </div>
          
        </div>
        <!-- Google Map -->
        <div class="map" data-latitude="-37.817240" data-longitude="144.955826" data-style="light"
          data-info="">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3483.9868899529206!2d-51.49718598437945!3d-29.165058582210666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951c23421d1cf03d%3A0xc294114986469945!2sRadax%20do%20Brasil!5e0!3m2!1spt-BR!2sbr!4v1599128357955!5m2!1spt-BR!2sbr" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <!-- end: Google Map -->
      </div>
    </div>
  </div>
</section>



@endsection