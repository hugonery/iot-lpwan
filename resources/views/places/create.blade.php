@extends('layouts.app')

@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
          <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Propriedades: Cadastro</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" method="post" action="{{ route('places.store') }}"  name="FormPlace" novalidate>
                    
                            {{ csrf_field() }}
                            
                            @include('places.form')
                            
                            <div class="form-row p-4">
                              <button class="btn btn-primary" type="submit" onclick="return checkFormPlace();">Cadastrar Propriedade</button>
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @section('script')

    <script language=JavaScript>

      document.FormPlace.name.focus();
           
      function checkFormPlace()
      {
      
        if (FormPlace.postalcode.value == 0) {
          swal({
            type: 'error',
            title: 'Digite o CEP do endereço!',
            confirmButtonText: 'ok',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
          }).then( function () {
            document.FormPlace.postalcode.focus();
          }, function (dismiss) {
            document.FormPlace.postalcode.focus();
          });
        return false;
        }

        if (FormPlace.state_id.value == 0) {
          swal({
            type: 'error',
            title: 'Selecione o Estado!',
            confirmButtonText: 'ok',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
          });
        return false;
        }

        if (FormPlace.city_id.value == 0) {
          swal({
            type: 'error',
            title: 'Selecione a Cidade!',
            confirmButtonText: 'ok',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
          });
        return false;
        }

        if (FormPlace.district_id.value == 0) {
          swal({
            type: 'error',
            title: 'Selecione o Bairro!',
            confirmButtonText: 'ok',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
          });
        return false;
        }

      }
      
    </script>

    <script src="{{ url('assets/js/form.validation.script.js')}}"></script>
    <script src="{{ url('assets/js/jquery.mask.js')}}"></script>
    <script src="{{ url('assets/js/form.validation.cpf.js')}}"></script>
    <script src="{{ url('assets/js/form.validation.cnpj.js')}}"></script>

    <script src="{{ url('assets/js/examples/sweet-alert.js') }}"></script>

    <script src="{{ url('vendors/prism/prism.js') }}"></script>
     
    @endsection

@endsection