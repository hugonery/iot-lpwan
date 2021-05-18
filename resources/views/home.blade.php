@extends('layouts.app')

@section('head')
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}">

    <!-- Vmap -->
    <link rel="stylesheet" href="{{ url('vendors/vmap/jqvmap.min.css') }}">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>CRM</h4>
            <!--
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">CRM Clara Ideia</li>
                </ol>
            </nav>
            -->
        </div>
    </div>
    <!-- end::page-header -->

    <!-- begin::page content -->
    <div class="container-fluid">



        <div class="row">

            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="card-title mb-3">Clientes</h6>
                                        <div class="d-flex d-sm-block d-lg-flex align-items-end">
                                            <h2 class="mb-0 mr-2 font-weight-bold">{{ @$users_all }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-success-bright text-success rounded-circle">
                                                <i class="fa fa-address-book-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="card-title mb-3">Propriedades</h6>
                                        <div class="d-flex d-sm-block d-lg-flex align-items-end">
                                            <h2 class="mb-0 mr-2 font-weight-bold">{{ @$places_all }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-success-bright text-success rounded-circle">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="card-title mb-3">Estações</h6>
                                        <div class="d-flex d-sm-block d-lg-flex align-items-end">
                                            <h2 class="mb-0 mr-2 font-weight-bold">{{ @$stations_all }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-success-bright text-success rounded-circle">
                                                <i class="fa fa-wifi"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="card-title mb-3">Sensores</h6>
                                        <div class="d-flex d-sm-block d-lg-flex align-items-end">
                                            <h2 class="mb-0 mr-2 font-weight-bold">{{ @$sensors_all }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-success-bright text-success rounded-circle">
                                                <i class="fa fa-thermometer-half"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-md-flex align-items-start justify-content-between">
                                    <h6 class="card-title">Últimos clientes cadastrados</h6>
                                    <!--
                                    <div class="reportrange btn btn-outline-light btn-sm mt-3 mt-md-0">
                                        <i class="ti-calendar mr-2"></i>
                                        <span class="text"></span>
                                        <i class="ti-angle-down ml-2"></i>
                                    </div>
                                    -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">#</th>
                                                        <th scope="col">Nome</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col" class="text-center">CPF/CNPJ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($users as $user)
                                                      <tr>
                                                        <th scope="row" class="text-center">{{ $user->id }}</th>
                                                        <td>
                                                            <b><a href="{{ route('users.show', $user->id) }}" class="text-success mr-2">{{ $user->name }}</a></b>
                                                        </td>
                                                        <td>
                                                          {{ $user->email }}
                                                        </td>
                                                        <td class="text-center">
                                                          @if ($user->type==1)
                                                            {{ preg_replace("/^(\d{3})(\d{3})(\d{3})(\d{2})$/", "\\1.\\2.\\3-\\4", str_pad($user->cpf, 11, "0", STR_PAD_LEFT)) }}
                                                          @elseif ($user->type==2)
                                                            {{ preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/", "\\1.\\2.\\3/\\4-\\5", str_pad($user->cpf, 14, "0", STR_PAD_LEFT)) }}
                                                          @endif
                                                        </td>
                                                      </tr>
                                                      @empty
                                                      <tr>
                                                          <td colspan="4">Nenhum registro encontrado</td>
                                                      </tr>
                                                    @endforelse
                                                  </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between">
                                    <h6 class="card-title">Sensores</h6>
                                    <div>
                                        <a href="#" class="mr-3">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <span class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Report</a>
                                                    <a href="#" class="dropdown-item">Download</a>
                                                    <a href="#" class="dropdown-item">Close</a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between">
                                    <h6 class="card-title">Sensores</h6>
                                    <div>
                                        <a href="#" class="mr-3">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <span class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Report</a>
                                                    <a href="#" class="dropdown-item">Download</a>
                                                    <a href="#" class="dropdown-item">Close</a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="contacts-statuses"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end::page content -->

@endsection

@section('script')
    <!-- Chartjs -->
    <script src="{{ url('vendors/charts/chartjs/chart.min.js') }}"></script>

    <!-- Apex chart -->
    <script src="{{ url('vendors/charts/apex/apexcharts.min.js') }}"></script>

    <!-- Circle progress -->
    <script src="{{ url('vendors/circle-progress/circle-progress.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ url('vendors/charts/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('assets/js/examples/charts/peity.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>

    <!-- Vamp -->
    <script src="{{ url('vendors/vmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ url('vendors/vmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ url('assets/js/examples/vmap.js') }}"></script>

    <!-- Dashboard scripts -->
    <script src="{{ url('assets/js/examples/dashboard.js') }}"></script>
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
@endsection
