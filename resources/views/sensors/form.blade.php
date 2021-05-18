<div class="form-row p-2">
    
  <div class="col-md-4 mb-3">
      <label for="name">Estação</label>
      <input type="text" class="form-control" id="name_station" name="name_station" value="{{ @$station->name }}" palceholder="Nome" maxlength="100" disabled readonly>
      <input type="hidden" name="station_id" id="station_id" value="{{ @$station->id }}">
  </div>

  <div class="col-md-4 mb-3">
      <label for="name">Nome do Sensor</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ @$sensor->name }}" placeholder="Digite o nome da Estação" maxlength="50" required>
      <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

  <div class="col-md-4 mb-3">
    <label for="description">Descrição</label>
    <input type="text" class="form-control" id="description" name="description" value="{{ @$sensor->description }}" placeholder="" maxlength="200">
    <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
  </div>

</div>