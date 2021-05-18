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
            <h4><i class="fa fa-address-book-o" aria-hidden="true"></i> Clientes: Consulta</h4>
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
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                  <tr>
                                      <td>
                                          <h6><b><a href="{{ route('users.show', $user->id) }}" class="text-success mr-2">{{ $user->name }}</a></b></h6>
                                      </td>
                                      <td>
                                          @if ($user->type==1)
                                            {{ preg_replace("/^(\d{3})(\d{3})(\d{3})(\d{2})$/", "\\1.\\2.\\3-\\4", str_pad($user->cpf, 11, "0", STR_PAD_LEFT)) }}
                                          @elseif ($user->type==2)
                                            {{ preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/", "\\1.\\2.\\3/\\4-\\5", str_pad($user->cpf, 14, "0", STR_PAD_LEFT)) }}
                                          @endif
                                      </td>
                                      <td>
                                          @if (strlen($user->phone1)<=10)
                                            {{ preg_replace("/^(\d{2})(\d{4})(\d{4})$/", "(\\1) \\2-\\3", $user->phone1) }}
                                          @else
                                            {{ preg_replace("/^(\d{2})(\d{5})(\d{4})$/", "(\\1) \\2-\\3", $user->phone1) }}
                                          @endif
                                      </td>
                                      <td>
                                          {{ $user->email }}
                                      </td>
                                      <td>
                                        @if ($user->status==1)
                                          <span class="badge badge-success">Ativo</span>
                                        @else
                                          <span class="badge badge-danger">Desativado</span>
                                        @endif
                                      </td>
                                      <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm m-1">Editar</a>
                                        @if ($user->status==1)
                                          <form style="display: inline" action="{{ route('users.destroy', $user->id) }}" method="post"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm m-1" onclick="return confirm('Tem certeza que deseja desativar o cliente?')">Desativar</button>
                                          </form>
                                        @endif
                                      </td>
                                  </tr>
                                @empty
                                  <tr>
                                      <td colspan="5">Nenhum registro encontrado</td>
                                  </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>Nome</th>
                                  <th>CPF/CNPJ</th>
                                  <th>Telefone</th>
                                  <th>Email</th>
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