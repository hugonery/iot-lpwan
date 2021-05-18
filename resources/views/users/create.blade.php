@extends('layouts.app')

@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4><i class="fa fa-address-book-o" aria-hidden="true"></i> Clientes: Cadastro</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" method="post" action="{{ route('users.store') }}"  name="FormUser" novalidate>
                    
                            {{ csrf_field() }}
                            
                            @include('users.form')
                            
                            <div class="form-row p-4">
                              <button class="btn btn-primary" type="submit" onclick="return checkFormUser();">Cadastrar Cliente</button>
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @section('script')
    
    <script language=JavaScript>
        
        document.FormUser.cpfcnpj.focus();
        
        /////////////// MASCARA PARA O TELEFONE PRINCIPAL
        $("#phone1").keydown(function()
        {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('#phone1').mask(SPMaskBehavior, spOptions);
        });
        
        /////////////// MASCARA PARA O TELEFONE 2
        $("#phone2").keydown(function()
        {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('#phone2').mask(SPMaskBehavior, spOptions);
        });
        
        /////////////// MASCARA PARA O TELEFONE DE RECADO 1
        $("#personphone1").keydown(function()
        {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('#personphone1').mask(SPMaskBehavior, spOptions);
        });
        
        /////////////// MASCARA PARA O TELEFONE DE RECADO 2
        $("#personphone2").keydown(function()
        {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('#personphone2').mask(SPMaskBehavior, spOptions);
        });
        
        /////////////// MASCARA PARA O CPF E CNPJ
        $("#cpfcnpj").keydown(function()
        {
        var cpfMascara = function (val) {
            return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
        },
        cpfOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(cpfMascara.apply({}, arguments), options);
            }
        };
        if (FormUser.type.value==1)
        $('#cpfcnpj').mask('000.000.000-00', cpfOptions);
        else
        $('#cpfcnpj').mask('00.000.000/0000-00', cpfOptions);
        });
        
        function checkFormUser()
        {
        if (FormUser.cpfcnpj.value!="")
        {
            if (FormUser.type.value==1)
            {
                if (validarCPF(FormUser.cpfcnpj.value)==false)
                {
                swal("CPF inválido!", "", "error").then( function () {
                    document.FormUser.cpfcnpj.focus();
                }, function (dismiss) {
                    document.FormUser.cpfcnpj.focus();
                });

                return false;
                }
            }
            else
            {
                if (validarCNPJ(FormUser.cpfcnpj.value)==false)
                {
                swal("CNPJ inválido!", "", "error").then( function () {
                    document.FormUser.cpfcnpj.focus();
                }, function (dismiss) {
                    document.FormUser.cpfcnpj.focus();
                });

                return false;
                }
            }
        }
        
        if (FormUser.postalcode.value == 0) {
            swal("Digite o CEP do endereço!", "", "error").then( function () {
            document.FormUser.postalcode.focus();
            }, function (dismiss) {
            document.FormUser.postalcode.focus();
            });
        return false;
        }

        if (FormUser.state_id.value == 0) {
            swal("Selecione o Estado!", "", "error");
        return false;
        }

        if (FormUser.city_id.value == 0) {
            swal("Selecione a Cidade!", "", "error");
        return false;
        }

        if (FormUser.district_id.value == 0) {
            swal("Selecione o Bairro!", "", "error");
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
