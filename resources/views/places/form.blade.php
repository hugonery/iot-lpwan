<div class="form-row p-2">
    
  <div class="col-md-1 mb-3">
      <label class="radio radio-warning">
          <input type="radio" name="type" value="1" @if ((@$place->type==0) || (@$place->type==1)) checked @endif >
        <span><b>Residencial</b></span>
        <span class="checkmark"></span>
      </label>

      <label class="radio radio-danger">
        <input type="radio" name="type" value="2" @if (@$place->type==2) checked @endif >
        <span><b>Comercial</b></span>
        <span class="checkmark"></span>
      </label>
  </div>

  <div class="col-md-4 mb-3">
      <label for="name">Cliente</label>
      <input type="text" class="form-control" id="name_user" name="name_user" value="{{ @$user->name }}" placeholder="Nome" maxlength="100" disabled readonly>
      <input type="hidden" name="user_id" id="user_id" value="{{ @$user->id }}">
  </div>

  <div class="col-md-7 mb-3">
      <label for="name">Nome do Local</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ @$place->name }}" placeholder="Exemplo: Residencia" maxlength="50" required>
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

</div>

<div class="form-row p-2">

  <div class="col-md-3 mb-3">
      <label for="postalcode">CEP</label> <img src="{{asset('assets/images/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep/exec.php?FORM=FormPlace&cep='+(document.FormPlace.postalcode.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input type="text" class="form-control" id="postalcode" name="postalcode" value="@if (Route::current()->uri=='places/create/{id}') {{ @$user->postalcode }} @else {{ @$place->postalcode }} @endif" placeholder="CEP" data-mask="00000-000" data-mask-reverse="true" required onblur="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep/exec.php?FORM=FormPlace&cep='+(document.FormPlace.postalcode.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')">
  </div>

  <div class="col-md-3 mb-3">
      <label for="state_name">Estado</label> <img src="{{asset('assets/images/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep-estado/exec.php?FORM=FormPlace','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input class="form-control" name="state_name" value="{{ @$state->name }}" type="text" placeholder="Busque pelo CEP" id="state_name" value="" maxlength="60" disabled readonly />
      <input name="state_id" type="hidden" value="{{ @$user->state_id }}" />
      <div class="invalid-feedback">
          <b>O nome do estado é obrigatório!</b>
      </div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="city_name">Cidade</label> <img src="{{asset('assets/images/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep-cidade/exec.php?FORM=FormPlace&state_id='+(document.FormPlace.state_id.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input class="form-control" name="city_name" value="{{ @$city->name }}" type="text" placeholder="Busque pelo CEP" id="city_name" value="" maxlength="60" disabled readonly />
      <input name="city_id" type="hidden" value="{{ @$user->city_id }}" />
      <div class="invalid-feedback">
          <b>O nome da cidade é obrigatório!</b>
      </div>
  </div>

  <div class="col-md-3 mb-3">
      <label for="district_name">Bairro</label> <img src="{{asset('assets/images/busca.gif')}}" width="16" height="14" onclick="window.open('{{ $_SERVER['APP_URL'] }}/busca-cep-bairro/exec.php?FORM=FormPlace&city_id='+(document.FormPlace.city_id.value)+'','busca_cep','width=700,height=450,toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,screenX=200,screenY=200,top=200,left=200')" />
      <input class="form-control" name="district_name" value="{{ @$district->name }}" type="text" placeholder="Busque pelo CEP" id="district_name" value="" maxlength="60" disabled readonly />
      <input name="district_id" type="hidden" value="{{ @$user->district_id }}" />
      <div class="invalid-feedback">
          <b>O nome do bairro é obrigatório!</b>
      </div>
  </div>

</div>

<div class="form-row p-2">

  <div class="col-md-6 mb-3">
      <label for="address">Endereço (Rua, Quadra, Lote, Número...)</label>
      <input type="text" class="form-control" id="address" name="address" value="@if (Route::current()->uri=='places/create/{id}') {{ @$user->address }} @else {{ @$place->address }} @endif" placeholder="Endereço" maxlength="180" required>
  </div>

  <div class="col-md-3 mb-3">
    <label for="lat">Latitude</label>
    <input type="text" class="form-control" id="lat" name="lat" value="{{ @$place->lat }}" placeholder="Latitude" maxlength="100">
    <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>
  <div class="col-md-3 mb-3">
      <label for="lng">Longitude</label>
      <input type="text" class="form-control" id="lng" name="lng" value="{{ @$place->lng }}" placeholder="Longitude" maxlength="100">
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

</div>