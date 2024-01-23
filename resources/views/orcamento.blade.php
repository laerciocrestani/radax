@extends('main')
@section('content')

<section id="page-title" class="page-title-center" data-parallax-speed="1"
  data-parallax-image="/images/banner-interno.jpg">
  <div class="container">
    <div class="page-title">
      <h1>Orçamento</h1>
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


      <!-- Sidebar-->
      <div class="col-lg-4">
        <h3 class="text-uppercase"></h3>
        <p>Preencha os campos abaixo que entraremos em contato via fone ou email com os valores orçados.</p>

        <div class="m-t-30">
          <form class="widget-contact-form" action="{{route('orcamento.enviar')}}" role="form" method="post">
            @csrf
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" aria-required="true" name="nome" class="form-control required nome">
              </div>
              <div class="form-group col-md-6">
                <label for="email">Fone</label>
                <input type="text" aria-required="true" name="fone" class="form-control fone required">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="subject">CPF/CNPJ</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control required" aria-required="true">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="subject">Email</label>
                <input type="email" name="email" class="form-control required email" aria-required="true">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="subject">Cidade</label>
                {{Form::select('cidade_id', $cidades, null, ['id'=>'cidades', 'class' =>'form-control', 'required'])}}
              </div>
            </div>
            <div class="form-group">
              <label for="message">Observações</label>
              <textarea type="text" name="observacoes" rows="5" class="form-control required"
                aria-required="true"></textarea>
            </div>

            <div class="form-group">
              <script src="https://www.google.com/recaptcha/api.js?render=6Le706kZAAAAANWGKGPLn2w1IgZfTtIzWhysMo4x">
              </script>
              <script>
                grecaptcha.ready(function() {
                // do request for recaptcha token
                // response is promise with passed token
                grecaptcha.execute('6Le706kZAAAAANWGKGPLn2w1IgZfTtIzWhysMo4x', {action:'validate_captcha'})
                .then(function(token) {
                // add token value to form
                document.getElementById('g-recaptcha-response').value = token;
                });
                });
              </script>


            </div>
            <button class="btn" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Solicitar</button>
          </form>

        </div>
      </div>
      <!-- Content-->
      <div class="content col-md-8">
        <div class="row m-b-20">
          <div class="col-md-9 p-t-10 m-b-20">
            <h3 class="m-b-20">Produtos</h3>
          </div>
        </div>
        <!--Product list-->
        <div class="shop">
          @if(Cart::getContent()->count())
          <div class="grid-layout grid-4-columns" data-item="grid-item">
            @foreach ($cart as $produto)
            <div class="grid-item">
              <div class="product">
                <div class="product-image">
                  <a
                    href="{{route('produto', ['categoria'=>$produto->attributes->categoria_slug, 'produto'=>str_replace('/','@',$produto->name), 'slug'=>str_slug($produto->name)])}}">

                    @if($produto->attributes->imagem != '')
                    <img class="cover" alt="Shop product image!"
                      src="{{env("IMGS").$produto->attributes->imagem.'.jpg'}}">
                    @else
                    <img class="cover" alt="Shop product image!" src="/images/produto-sem-imagem-p.gif">
                    @endif
                  </a>
                  <span class="product-new hide">NEW</span>
                  <span class="product-wishlist">
                    <a href="{{route('orcamento-remover', str_replace('/','@',$produto->id))}}"><i
                        class="fa fa-close"></i></a>
                  </span>
                </div>
                <div class="product-description">

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <input type="number" data-value="{{str_replace('/','@',$produto->id)}}"
                        class="form-control required carrinho-input" value="{{$produto->quantity}}"
                        aria-required="true">
                    </div>
                  </div>

                  <div class="product-category hide">{{$produto->attributes->categoria_slug}}</div>
                  <div class="product-title">
                    <h3><a
                        href="{{route('produto', ['categoria'=>$produto->attributes->categoria_slug, 'produto'=>str_replace('/','@',$produto->name), 'slug'=>str_slug($produto->name)])}}">{{$produto->name}}</a>
                    </h3>
                  </div>


                </div>
              </div>
            </div>

            @endforeach
          </div>
          <hr>
          @else
          <div class="alert alert-info">
            <p>Não há podutos em seu orçamento.</p>
          </div>
          @endif


        </div>
        <!--End: Product list-->
      </div>
      <!-- end: Content-->
      <!-- end: Sidebar-->
    </div>
  </div>
</section>
<!-- end: Shop products -->

@endsection

@push('js')
<script type="text/javascript">
  $(function(){
    var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.fone').mask(SPMaskBehavior, spOptions);
    //
    $("#cpf_cnpj").keydown(function(){
    try {
        $("#cpf_cnpj").unmask();
    } catch (e) {}

    var tamanho = $("#cpf_cnpj").val().length;

    if(tamanho < 11){
        $("#cpf_cnpj").mask("999.999.999-99");
    } else {
        $("#cpf_cnpj").mask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function(){
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
});
    //
  $('.carrinho-input').on('change', function (e){
    var _codAlt = $(this).data('value');
    e.preventDefault();
        _url = '/orcamento/atualizar/'+_codAlt+'/'+$(this).val();
        $.get(_url, function(data, status){
          $.notify({
              message: 'Produto atualizado com sucesso!'
          }, {
              type: 'success',
              offset: {
                x: 10,
                y: 91
              },
          });
          $('#sci').html(data.cart_itens);
      });
      
    });
  });
</script>
@endpush