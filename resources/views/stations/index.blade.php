@extends('layouts.app')

@section('head')
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/dataTables.min.css') }}" type="text/css">

    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4><i class="fa fa-wifi" aria-hidden="true"></i> Estações: Consulta</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        @include('alerts')
                        
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Propriedade</th>
                                    <th>Estação</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stations as $station)
                                    @php
                                        $place = \App\Places::find($station->place_id);
                                        $user = \App\Users::find($place->user_id);
                                    @endphp
                                  <tr>
                                      <td>
                                        <h6><b><a href="{{ route('users.show', $user->id) }}" class="text-success mr-2">{{ $user->name }}</a></b></h6>
                                      </td>
                                      <td>
                                            {{ $place->name }}
                                      </td>
                                      <td>
                                            {{ $station->name }}
                                      </td>
                                      <td>
                                        @if ($station->status==1)
                                          <span class="badge badge-success">Ativa</span>
                                        @else
                                          <span class="badge badge-danger">Desativada</span>
                                        @endif
                                      </td>
                                      <td>
                                        <a href="{{ route('stations.edit', $station->id) }}" class="btn btn-primary btn-sm m-1">Editar</a>
                                        @if ($station->status==1)
                                          <form style="display: inline" action="{{ route('stations.destroy', $station->id) }}" method="post"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <input type="hidden" name="place_id" id="place_id" value="{{ @$station->place_id }}">
                                            <button type="submit" class="btn btn-danger btn-sm m-1" onclick="return confirm('Tem certeza que deseja desativar a estação?')">Desativar</button>
                                          </form>
                                        @endif
                                      </td>
                                  </tr>
                                @empty
                                  <tr>
                                      <td colspan="6">Nenhum registro encontrado</td>
                                  </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Propriedade</th>
                                    <th>Localização</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@section('script')
    <!-- DataTable -->
    <script src="{{ url('vendors/dataTable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/js/examples/datatable.js') }}"></script>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection