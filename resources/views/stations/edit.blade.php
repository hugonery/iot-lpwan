@extends('layouts.app')

@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
          <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Estações: Alteração do Cadastro</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                      <form class="needs-validation" method="post" action="{{ route('stations.update', $station->id) }}"  name="FormPlace" novalidate>
                          
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                            
                        @include('stations.form')
                        
                        <div class="form-row p-4">
                          <button class="btn btn-primary" type="submit" onclick="return checkFormPlace();">Alterar Cadastro</button>
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
      
    </script>

    <script src="{{ url('assets/js/form.validation.script.js')}}"></script>
    <script src="{{ url('assets/js/jquery.mask.js')}}"></script>
    <script src="{{ url('assets/js/form.validation.cpf.js')}}"></script>
    <script src="{{ url('assets/js/form.validation.cnpj.js')}}"></script>

    <script src="{{ url('assets/js/examples/sweet-alert.js') }}"></script>

    <script src="{{ url('vendors/prism/prism.js') }}"></script>
     
    @endsection

@endsection