<div class="form-row p-2">
    
  <div class="col-md-1 mb-3">

    <div class="custom-control custom-radio">
        <input type="radio" id="type1" name="type" value="1" @if ( (@$user->type==0) || (@$user->type==1) ) checked @endif class="custom-control-input" >
        <label class="custom-control-label" for="type1">PF</label>
    </div>

    <div class="custom-control custom-radio">
        <input type="radio" id="type2" name="type" value="2" @if (@$user->type==2) checked @endif class="custom-control-input" >
        <label class="custom-control-label" for="type2">PJ</label>
    </div>

  </div>
    
  <div class="col-md-2 mb-3">
      <label for="cpf">CPF ou CNPJ</label>
      <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" value="{{ @$user->cpf }}" >
  </div>

  <div class="col-md-6 mb-3">
      <label for="name">Nome</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ @$user->name }}" placeholder="Nome" maxlength="100" required>
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="birth">Data de Nascimento</label>
      <input id="birth" name="birth" value="{{ @$user->birth }}" class="form-control" placeholder="dd/mm/yyyy" type="date">
  </div>

</div>

<div class="form-row p-2">

  <div class="col-md-3 mb-3">
      <label for="name">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ @$user->email }}" placeholder="Email" maxlength="100" required>
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="phone1">Telefone Principal</label>
      <input type="text" class="form-control" id="phone1" name="phone1" value="{{ @$user->phone1 }}" placeholder="Telefone Principal" required>
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="phone2">Telefone</label>
      <input type="text" class="form-control" id="phone2" name="phone2" value="{{ @$user->phone2 }}" placeholder="Telefone">
  </div>

  <div class="col-md-3 mb-3">
    <label for="gender">Sexo</label>
    <select class="form-control" name="gender" id="gender">
        <option value="3" @if ( (@$user->gender==3) || (@$user->gender==0) ) selected="selected" @endif >não informado</option>
        <option value="2" @if (@$user->gender==2) selected="selected" @endif >Feminino</option>
        <option value="1" @if (@$user->gender==1) selected="selected" @endif >Masculino</option>
    </select>
</div>

</div>

<div class="form-row p-2">

  <div class="col-md-3 mb-3">
      <label for="person1">Recado #1 - Nome</label>
      <input type="text" class="form-control" id="person1" name="person1" value="{{ @$user->person1 }}" placeholder="Nome da pessoa" maxlength="50">
  </div>

  <div class="col-md-3 mb-3">
      <label for="personphone1">Recado #1 - Telefone</label>
      <input type="text" class="form-control" id="personphone1" name="personphone1" value="{{ @$user->personphone1 }}" placeholder="Telefone">
  </div>

  <div class="col-md-3 mb-3">
      <label for="person2">Recado #2 - Nome</label>
      <input type="text" class="form-control" id="person2" name="person2" value="{{ @$user->person2 }}" placeholder="Nome da pessoa" maxlength="50">
  </div>

  <div class="col-md-3 mb-3">
      <label for="personphone2">Recado #2 - Telefone</label>
      <input type="text" class="form-control" id="personphone2" name="personphone2" value="{{ @$user->personphone2 }}" placeholder="Telefone">
  </div>

</div>

<div class="form-row p-2">

  <div class="col-md-3 mb-3">
      <label for="postalcode">CEP</label> <img src="{{asset('assets/media/image/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep/exec.php?FORM=FormUser&cep='+(document.FormUser.postalcode.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ @$user->postalcode }}" placeholder="CEP" data-mask="00000-000" data-mask-reverse="true" required onblur="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep/exec.php?FORM=FormUser&cep='+(document.FormUser.postalcode.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')">
  </div>

  <div class="col-md-3 mb-3">
      <label for="state_name">Estado</label> <img src="{{asset('assets/media/image/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep-estado/exec.php?FORM=FormUser','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input class="form-control" name="state_name" value="{{ @$state->name }}" type="text" placeholder="Busque pelo CEP" id="state_name" value="" maxlength="60" disabled readonly />
      <input name="state_id" type="hidden" value="{{ @$user->state_id }}" />
      <div class="invalid-feedback">
          <b>O nome do estado é obrigatório!</b>
      </div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="city_name">Cidade</label> <img src="{{asset('assets/media/image/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep-cidade/exec.php?FORM=FormUser&state_id='+(document.FormUser.state_id.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input class="form-control" name="city_name" value="{{ @$city->name }}" type="text" placeholder="Busque pelo CEP" id="city_name" value="" maxlength="60" disabled readonly />
      <input name="city_id" type="hidden" value="{{ @$user->city_id }}" />
      <div class="invalid-feedback">
          <b>O nome da cidade é obrigatório!</b>
      </div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="district_name">Bairro</label> <img src="{{asset('assets/media/image/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep-bairro/exec.php?FORM=FormUser&city_id='+(document.FormUser.city_id.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input class="form-control" name="district_name" value="{{ @$district->name }}" type="text" placeholder="Busque pelo CEP" id="district_name" value="" maxlength="60" disabled readonly />
      <input name="district_id" type="hidden" value="{{ @$user->district_id }}" />
      <div class="invalid-feedback">
          <b>O nome do bairro é obrigatório!</b>
      </div>
  </div>

</div>

<div class="form-row p-2">

  <div class="col-md-4 mb-3">
      <label for="address">Endereço (Rua, Quadra, Lote, Número...)</label>
      <input type="text" class="form-control" id="address" name="address" value="{{ @$user->address }}" placeholder="Endereço" maxlength="180" required>
  </div>

  <div class="col-md-2 mb-3">
    <label for="webaccess"><b>WEB Admin</b></label>
    <select class="form-control" name="webaccess" id="webaccess">
        <option value="0" @if (@$user->webaccess==0) selected="selected" @endif >NÃO</option>
        <option value="1" @if (@$user->webaccess==1) selected="selected" @endif >Sim</option>
    </select>
  </div>

  <div class="col-md-2 mb-3">
    <label for="adminappaccess"><b>APP Admin</b></label>
    <select class="form-control" name="adminappaccess" id="adminappaccess">
        <option value="0" @if (@$user->adminappaccess==0) selected="selected" @endif >NÃO</option>
        <option value="1" @if (@$user->adminappaccess==1) selected="selected" @endif >Sim</option>
    </select>
  </div>

  <div class="col-md-4 mb-3">
      <label for="note">Observações:</label>
      <textarea name="note" id="note" cols="20" rows="4" class="form-control" style="height: 100px;">{{ @$user->note }}</textarea>
  </div>

</div>
