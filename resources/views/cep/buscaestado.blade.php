<?php
@$BUSCA = $_POST["BUSCA"];

$states = \App\States::where('name' , 'LIKE',  '%'.$BUSCA.'%')->get();

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} - BUSCA ESTADO</title>

  <link rel="stylesheet" href="{{asset('assets/css/buscas.css')}}">  
</head>

<body bgcolor="f9f9f9" onLoad="document.form1.BUSCA.focus()">

  <div id="apDiv1">
    <table width="96%" border="0" cellspacing="2" cellpadding="2" class="geral" align="center">
        <form id="form1" name="form1" method="post" action="{{ $_SERVER['APP_URL'] }}/busca-cep-estado/exec.php?FORM={{$_GET['FORM']}}">
          {{ csrf_field() }}
          <tr>
            <td width="150" class="style1" style="color: #fff;">Buscar Estado: </td>
            <td>
              <label>
                <input name="BUSCA" type="text" class="form" id="BUSCA" />
                <input name="button" id="botaoFormulario" type="submit" class="form" id="button" value="buscar" />
              </label>
            </td>
          </tr>
        </form>
    </table>
  </div>

  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" align="center">
    <tr>
     <td height="15" colspan="2" background="{{asset('assets/media/image/busca_1.jpg')}}">
         <img name="index_r1_c1" src="{{asset('assets/media/image/busca_1.jpg')}}" width="1" height="15" border="0">
     </td>
    </tr>

    <tr>
      <td colspan="2" valign="top"> 
      <table width="96%" border="0" cellspacing="2" cellpadding="2" class="geral" align="center">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>        

          @forelse ($states as $state)
            <tr>
              <td colspan="2"><a href="#" class="style2" onClick="javascript:InsereTipo('{{str_replace("\r\n","",trim($state['name']))}}','{{$state['id']}}')">{{str_replace("\r\n","",trim($state['name']))}}</a></td>
            </tr>
          @empty
            <tr>
              <td colspan="2" class="style2" style="color: red;">Nenhum cadastro encontrado!</td>
            </tr>
          @endforelse

          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>   

      </td>
    </tr>
  </table>

  <script language=JavaScript>
    function InsereTipo(Nome, Id)
    {
      
      if (opener.document.{{$_GET['FORM']}}.state_name.value != Nome)
      {
        opener.document.{{ $_GET['FORM'] }}.city_name.value = '';
        opener.document.{{ $_GET['FORM'] }}.city_id.value = '';
        opener.document.{{ $_GET['FORM'] }}.district_name.value = '';
        opener.document.{{ $_GET['FORM'] }}.district_id.value = '';
      }

      opener.document.{{ $_GET['FORM'] }}.state_name.value = Nome;
      opener.document.{{ $_GET['FORM'] }}.state_id.value = Id;

      self.close();
    }
    </script>
    
  </body>
</html>