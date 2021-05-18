<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - BUSCA CEP</title>
    
    <link rel="stylesheet" href="{{asset('assets/css/buscas.css')}}">  
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}" type="text/css">
    
</head>

<body class="text-left">

  <img src="{{asset('assets/media/image/busca-cep.gif')}}" />

  <?php

  $resultado['resultado'] = 0;
  $district['id'] = 0;

  if ($_GET['cep']>0)
  {
    @$webservice_url     = 'http://webservice.uni5.net/web_cep.php';
    @$webservice_query    = array(
        'auth'    => '484dc9e07747e988038013eef318c260', //Chave de autentica��o do WebService - Consultar seu painel de controle
        'formato' => 'query_string', //Valores poss�veis: xml, query_string ou javascript
        'cep'     => $_GET['cep'] //CEP que ser� pesquisado
    );

    //Forma URL
    @$webservice_url .= '?';
    foreach($webservice_query as $get_key => $get_value){
        $webservice_url .= $get_key.'='.urlencode($get_value).'&';
    }

    @parse_str(file_get_contents($webservice_url), $resultado);

  }

  // https://laravel.com/docs/5.2/queries#where-clauses
  
  if($resultado['resultado']>0)
  {
    $state = \App\States::where('uf' , '=',  utf8_encode($resultado['uf']))->first();

    $city = \App\Cities::where('state_id', '=', $state['id'])->where('name', '=', utf8_encode($resultado['cidade']))->first();
    if ($city['id']<=0) {
      \App\Cities::insert(['state_id' => $state['id'], 'name' => utf8_encode($resultado['cidade'])]);
      $city = \App\Cities::where('state_id', '=', $state['id'])->where('name', '=', utf8_encode($resultado['cidade']))->first();
    }

    $district = \App\Districts::where('city_id', '=', $city['id'])->where('name', '=', utf8_encode($resultado['bairro']))->first();
    if ($district['id']<=0) {
      \App\Districts::insert(['city_id' => $city['id'], 'name' => utf8_encode($resultado['bairro'])]);
      $district = \App\Districts::where('city_id', '=', $city['id'])->where('name', '=', utf8_encode($resultado['bairro']))->first();
    }
  }


  ?>

  @if ($district['id'] > 0)
    <script language=JavaScript>
      opener.document.{{ $_GET['FORM'] }}.address.value = '{{utf8_encode($resultado['tipo_logradouro'].' '.$resultado['logradouro'])}}';
      opener.document.{{ $_GET['FORM'] }}.state_name.value = '{{$state['name']}}';
      opener.document.{{ $_GET['FORM'] }}.state_id.value = '{{$state['id']}}';
      opener.document.{{ $_GET['FORM'] }}.city_name.value = '{{$city['name']}}';
      opener.document.{{ $_GET['FORM'] }}.city_id.value = '{{$city['id']}}';
      opener.document.{{ $_GET['FORM'] }}.district_name.value = '{{$district['name']}}';
      opener.document.{{ $_GET['FORM'] }}.district_id.value = '{{$district['id']}}';
      opener.document.{{ $_GET['FORM'] }}.address.focus()
      self.close();
    </script>
  @endif


  <script src="{{ url('vendors/bundle.js') }}"></script>
    

  @if ($district['id'] > 0)
    <script language=JavaScript>
      swal("Erro ao enviar os dados para o Formulário de Cadastro", "", "error").then( function () {
          self.close();
      }, function (dismiss) {
          self.close();
      });
    </script>
  @else
    <script language=JavaScript>
      swal("Erro ao consultar o CEP", "", "error").then( function () {
          self.close();
      }, function (dismiss) {
          self.close();
      });
    </script>
  @endif

</body>

</html>