@extends('layouts.app')

@section('head')
    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4><i class="fa fa-address-book-o" aria-hidden="true"></i> Clientes</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">
        
        @include('alerts')

        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="dropdown ml-auto p-3">
                        <a href="#" data-toggle="dropdown">
                            <i class="fa fa-info-circle fa-lg"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <p class="dropdown-item"><strong>{{ @$user->name }}</strong></p>
                            <a href="/users/{{ $user->id }}/edit" class="dropdown-item">Editar</a>
                            @if ($user->status==1)
                                <form style="display: inline" action="{{ route('users.destroy', $user->id) }}" method="post"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit" class="dropdown-item" style="color: red" onclick="return confirm('Tem certeza que deseja desativar o cliente?')">Desativar</button>
                                </form>
                            @endif
                            <a href="{{ '/places/create/'.$user->id }}" class="dropdown-item">+ Nova Propriedade</a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <figure class="avatar avatar-lg m-b-20">
                            <img src="{{ url('assets/media/image/user/user_avatar'.$user->gender.'.jpg') }}" class="rounded-circle" alt="...">
                        </figure>
                        <h3 class="mb-1">{{ @$user->name }}</h3>
                        <p class="text-muted">
                            @if ($user->type==1)
                                CPF {{ preg_replace("/^(\d{3})(\d{3})(\d{3})(\d{2})$/", "\\1.\\2.\\3-\\4", str_pad($user->cpf, 11, "0", STR_PAD_LEFT)) }}
                            @elseif ($user->type==2)
                                CNPJ {{ preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/", "\\1.\\2.\\3/\\4-\\5", str_pad($user->cpf, 14, "0", STR_PAD_LEFT)) }}
                            @endif
                        </p>
                        @if ($user->status==1)
                            <span class="badge badge-success text-14 align-items-baseline">Cliente Ativo</span>
                        @else
                            <span class="badge badge-danger text-14">Cliente Desativado</span>
                        @endif
                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4 text-success">
                                <h4 class="font-weight-bold">{{ @$places_all }}</h4>
                                <span>@if ($places_all>1) Propriedades @else Propriedade @endif</span>
                            </div>
                            <div class="col-4 text-info">
                                <h4 class="font-weight-bold">{{ @$stations_all }}</h4>
                                <span>@if ($stations_all>1) Estações @else Estação @endif</span>
                            </div>
                            <div class="col-4 text-warning">
                                <h4 class="font-weight-bold">{{ @$sensors_all }}</h4>
                                <span>@if ($sensors_all>1) Sensores @else Sensor @endif</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title d-flex justify-content-between align-items-center">Dados Cadastrais</h6>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Nome:</div>
                            <div class="col-6">{{ @$user->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Data de Nascimento:</div>
                            <div class="col-6">@if ($user->birth!='0000-00-00') {{ date('d/m/Y', strtotime($user->birth)) }} @endif</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Email:</div>
                            <div class="col-6">{{ @$user->email }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Telefone principal:</div>
                            <div class="col-6">
                              @if (strlen($user->phone1)<=10)
                                {{ preg_replace("/^(\d{2})(\d{4})(\d{4})$/", "(\\1) \\2-\\3", $user->phone1) }}
                              @else
                                {{ preg_replace("/^(\d{2})(\d{5})(\d{4})$/", "(\\1) \\2-\\3", $user->phone1) }}
                              @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Telefone #2:</div>
                            <div class="col-6">
                                @if (strlen($user->phone2)<=10)
                                    {{ preg_replace("/^(\d{2})(\d{4})(\d{4})$/", "(\\1) \\2-\\3", $user->phone2) }}
                                @else
                                    {{ preg_replace("/^(\d{2})(\d{5})(\d{4})$/", "(\\1) \\2-\\3", $user->phone2) }}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Endereço:</div>
                            <div class="col-6">{{ $user->address }}. {{ $district->name }}. {{ $city->name }} - {{ $state->name }}. CEP: {{ preg_replace("/^(\d{5})(\d{3})$/", "\\1-\\2", $user->postalcode) }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Recado #1:</div>
                            <div class="col-6">
                                {{ $user->person1 }}<br>
                                @if (strlen($user->personphone1)<=10)
                                    {{ preg_replace("/^(\d{2})(\d{4})(\d{4})$/", "(\\1) \\2-\\3", $user->personphone1) }}
                                @else
                                    {{ preg_replace("/^(\d{2})(\d{5})(\d{4})$/", "(\\1) \\2-\\3", $user->personphone1) }}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Recado #2:</div>
                            <div class="col-6">
                                {{ $user->person2 }}<br>
                                @if (strlen($user->personphone2)<=10)
                                    {{ preg_replace("/^(\d{2})(\d{4})(\d{4})$/", "(\\1) \\2-\\3", $user->personphone2) }}
                                @else
                                    {{ preg_replace("/^(\d{2})(\d{5})(\d{4})$/", "(\\1) \\2-\\3", $user->personphone2) }}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">WEB Admin:</div>
                            <div class="col-6">
                                @if ($user->webaccess==1)
                                    <span class="badge badge-success text-14 align-items-baseline">sim</span>
                                @else
                                    <span class="badge badge-danger text-14">não</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">APP Admin:</div>
                            <div class="col-6">
                                @if ($user->adminappaccess==1)
                                    <span class="badge badge-success text-14 align-items-baseline">sim</span>
                                @else
                                    <span class="badge badge-danger text-14">não</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Observações:</div>
                            <div class="col-6">{!! str_replace("\n", "<br>", $user->note) !!}</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">

                @forelse ($places as $place)
                  @php
                    $stations = \App\Stations::where('place_id', '=', $place->id)->orderBy('name', 'asc')->get();
                    $district = \App\Districts::find($place->district_id);
                    $city = \App\Cities::find($place->city_id);
                    $state = \App\States::find($place->state_id);
                  @endphp
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="d-inline-block">
                                            <div>
                                                <h5>
                                                    <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i> <strong>{{ $place->name }}</strong>
                                                    @if ($place->status==1)
                                                        <span class="badge badge-success text-14">Ativa</span>
                                                    @else
                                                        <span class="badge badge-danger text-14">Desativada</span>
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-auto">
                                        <a href="#" data-toggle="dropdown">
                                            <i class="fa fa-info-circle fa-lg"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <p class="dropdown-item"><strong>Propriedade</strong></p>
                                            <a href="/places/{{ $place->id }}/edit" class="dropdown-item">Editar</a>
                                            @if ($place->status==1)
                                                <form style="display: inline" action="{{ route('places.destroy', $place->id) }}" method="post"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                                    <input type="hidden" name="user_id" id="user_id" value="{{ @$user->id }}">
                                                    <button type="submit" class="dropdown-item" style="color: red" onclick="return confirm('Tem certeza que deseja desativar a propriedade?')">Desativar</button>
                                                </form>
                                            @endif
                                            <a href="{{ '/stations/create/'.$place->id }}" class="dropdown-item">+ Nova Estação</a>
                                        </div>
                                    </div>
                                </div>
                                <p>{{ $place->address }}. {{ $district->name }}. {{ $city->name }} - {{ $state->uf }}. <a href="https://www.google.com.br/maps/search/{{ $place->lat }},{{ $place->lng }}" target="_blank" class="badge badge-info text-14">Mapa</a></p>

                                @forelse ($stations as $station)
                                    @php
                                        $sensors = \App\Sensors::where('status', '=', 1)->where('station_id', '=', $station->id)->orderBy('name', 'asc')->get();
                                    @endphp
                                    <a href="#">
                                        <div class="row no-gutters border border-radius-1 p-3">
                                            <div class="dropdown ml-auto">
                                                <a href="#" data-toggle="dropdown">
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <p class="dropdown-item"><strong>Estação</strong></p>
                                                    <a href="/stations/{{ $station->id }}/edit" class="dropdown-item">Editar</a>
                                                    @if ($station->status==1)
                                                        <form style="display: inline" action="{{ route('stations.destroy', $station->id) }}" method="post"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                                            <input type="hidden" name="place_id" id="place_id" value="{{ @$place->id }}">
                                                            <button type="submit" class="dropdown-item" style="color: red" onclick="return confirm('Tem certeza que deseja desativar a estação?')">Desativar</button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ '/sensors/create/'.$station->id }}" class="dropdown-item">+ Novo Sensor</a>
                                                </div>
                                            </div>
                                            <div class="col-12 p-3">
                                                <h4>
                                                    <i class="fa fa-wifi" aria-hidden="true"></i> {{ $station->name }}
                                                    @if ($station->status==1)
                                                        <span class="badge badge-success text-14">Ativa</span>
                                                    @else
                                                        <span class="badge badge-danger text-14">Desativada</span>
                                                    @endif
                                                </h4>

                                                @forelse ($sensors as $sensor)
                                                    <h5 class="text-center">
                                                        <i class="fa fa-thermometer-half" aria-hidden="true"></i> {{ $sensor->name }} 
                                                        @if ($sensor->status==1)
                                                            <form style="display: inline" action="{{ route('sensors.destroy', $sensor->id) }}" method="post"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                                                <input type="hidden" name="station_id" id="station_id" value="{{ @$station->id }}">
                                                                <button type="submit" class="dropdown-item fa fa-times btn" style="color: red" style="color: red" onclick="return confirm('Tem certeza que deseja desativar a estação?')"></button>
                                                            </form>
                                                        @endif
                                                    </h5>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <canvas id="chartjs{{ $sensor->id }}"></canvas>
                                                        </div>
                                                    </div>
                                                    <br>
                                                @empty
                                                    <br><h5>Nenhum sensor cadastrado</h5>
                                                @endforelse

                                            </div>
                                        </div>
                                    </a>
                                    <br>
                                @empty
                                    <br><h5>Nenhuma estação cadastrada</h5>
                                @endforelse
  
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="d-inline-block">
                                                <h5>Nenhuma propriedade cadastrada</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse


            </div>
        </div>

    </div>

@endsection

@section('script')
    <!-- Chartjs -->
    <script src="{{ url('vendors/charts/chartjs/chart.min.js') }}"></script>

    <script language=JavaScript>
      
      'use strict';
    $(document).ready(function () {
    
        var colors = {
            primary: $('.colors .bg-primary').css('background-color'),
            primaryLight: $('.colors .bg-primary-bright').css('background-color'),
            secondary: $('.colors .bg-secondary').css('background-color'),
            secondaryLight: $('.colors .bg-secondary-bright').css('background-color'),
            info: $('.colors .bg-info').css('background-color'),
            infoLight: $('.colors .bg-info-bright').css('background-color'),
            success: $('.colors .bg-success').css('background-color'),
            successLight: $('.colors .bg-success-bright').css('background-color'),
            danger: $('.colors .bg-danger').css('background-color'),
            dangerLight: $('.colors .bg-danger-bright').css('background-color'),
            warning: $('.colors .bg-warning').css('background-color'),
            warningLight: $('.colors .bg-warning-bright').css('background-color'),
        };
    

        @forelse ($places as $place)
            @php
            $stations = \App\Stations::where('place_id', '=', $place->id)->orderBy('name', 'asc')->get();
            $district = \App\Districts::find($place->district_id);
            $city = \App\Cities::find($place->city_id);
            $state = \App\States::find($place->state_id);
            @endphp
            
            @forelse ($stations as $station)
                @php
                    $sensors = \App\Sensors::where('status', '=', 1)->where('station_id', '=', $station->id)->orderBy('name', 'asc')->get();
                @endphp
                    @forelse ($sensors as $sensor)

                        @php
                            $reads = \App\Reads::where('status', '=', 1)->where('sensor_id', '=', $sensor->id)->get();
                            $reads_max = \App\Reads::where('status', '=', 1)->where('sensor_id', '=', $sensor->id)->min('value');
                        @endphp

                        chartjs{{ $sensor->id }}();
        
                        function chartjs{{ $sensor->id }}() {
                            var element = document.getElementById("chartjs{{ $sensor->id }}");
                            element.height = 100;
                            new Chart(element, {
                                type: 'line',
                                data: {
                                    labels: [@forelse ($reads as $read) "{{ date('d/m/y H:i', strtotime($read->created_at)) }}", @empty @endforelse],
                                    datasets: [{
                                        data: [@forelse ($reads as $read) {{ @$read->value }}, @empty @endforelse],
                                        label: "medido",
                                        borderColor: colors.primary,
                                        backgroundColor: colors.primaryLight,
                                    }
                                    ]
                                }
                            });
                        }

                    @empty

                    @endforelse

            @empty
                
            @endforelse

        @empty

        @endforelse
    
    });
        
    </script>
    
    <div class="colors"> <!-- To use theme colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-bright"></div>
        <div class="bg-secondary"></div>
        <div class="bg-secondary-bright"></div>
        <div class="bg-info"></div>
        <div class="bg-info-bright"></div>
        <div class="bg-success"></div>
        <div class="bg-success-bright"></div>
        <div class="bg-danger"></div>
        <div class="bg-danger-bright"></div>
        <div class="bg-warning"></div>
        <div class="bg-warning-bright"></div>
    </div>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection