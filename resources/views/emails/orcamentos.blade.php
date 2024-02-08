<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title></title>
</head>

<body style="margin:0px; background: #f8f8f8; ">
  <div width="100%"
    style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
        <tbody>
          <tr>
            <td style="vertical-align: top; padding-bottom:30px;" align="center">
              <a href="https://radax.com.br" target="_blank">
                <img src="https://radax.com.br/images/logo.png" width="100px" alt=""
                  style="border:none"></a> </td>
          </tr>
        </tbody>
      </table>
      <div style="padding: 40px; background: #fff;">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
          <tbody>
            <tr>
              <td><strong>Orçamento via site, Radax.com.br</strong>
              
                <div>CPF/CNPJ: <strong>{{$cpf_cnpj}}</strong></div>
                <div>Nome : <strong>{{$nome}}</strong></div>
                <div>Fone: <strong>{{$fone}}</strong></div>
                <div>Email: <strong>{{$email}}</strong></div>
                <div>Observações: <br>{{$observacoes}}</div>
                  <h4>Itens de Orçamento:</h4>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #ccc">
                  <thead>
                    <tr>
                      <th style="text-aling:left"></th>
                      <th style="text-aling:left">Código/Nome</th>
                      <th style="text-aling:left">Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($carrinho as $produto)
                    <tr>
                      <td style="border: 1px solid #ccc">
                        @if($produto->attributes->imagem != '')
                        <img height="50px" 
                          src="{{env("IMGS").$produto->attributes->imagem.'.jpg'}}">
                        @else
                        <img  height="50px" src="https://radax.com.br/images/produto-sem-imagem-p.gif">
                        @endif
                      </td>
                      <td style="border: 1px solid #ccc">
                        {{str_replace('/','@',$produto->id)}} - 
                        {{$produto->name}}
                      </td>
                      <td style="border: 1px solid #ccc">
                        {{$produto->quantity}}
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
               
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
        <p> Enviado via radax.com.br<br>
        </p>
      </div>
    </div>
  </div>
</body>

</html>