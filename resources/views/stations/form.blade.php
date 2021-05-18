<div class="form-row p-2">
    
  <div class="col-md-4 mb-3">
      <label for="name">Propriedade</label>
      <input type="text" class="form-control" id="name_place" name="name_place" value="{{ @$place->name }}" placeholder="Nome" maxlength="100" disabled readonly>
      <input type="hidden" name="place_id" id="place_id" value="{{ @$place->id }}">
  </div>

  <div class="col-md-8 mb-3">
      <label for="name">Nome da Estação</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ @$station->name }}" placeholder="Digite o nome da Estação" maxlength="50" required>
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

</div>

<div class="form-row p-2">

  <div class="col-md-4 mb-3">
    <label for="lat">Latitude</label>
    <input type="text" class="form-control" id="lat" name="lat" value="{{ @$station->lat }}" maxlength="100">
    <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

  <div class="col-md-4 mb-3">
      <label for="lng">Longitude</label>
      <input type="text" class="form-control" id="lng" name="lng" value="{{ @$station->lng }}" maxlength="100">
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

  <div class="col-md-4 mb-3">
    <label for="alt">Altitude</label>
    <input type="text" class="form-control" id="alt" name="alt" value="{{ @$station->alt }}" maxlength="100">
    <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
</div>

</div>