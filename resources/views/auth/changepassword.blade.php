@extends('layouts.app')

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4><i class="fa fa-user-o" aria-hidden="true"></i> Alteração de Senha</h4>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        @include('alerts')

                        <form class="needs-validation" method="POST" name="FormUser" action="{{ route('changePassword') }}" novalidate>
                    
                            {{ csrf_field() }}
        
                            <div class="col-md-12 mb-3 {{ $errors->has('currentPassword') ? ' has-error' : '' }}">
                              <label for="currentPassword" class="col-md-3 control-label">Senha Atual</label>
                              <div class="col-md-3">
                                <input id="currentPassword" type="password" class="form-control" name="currentPassword" required>
                                <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
                              </div>
                            </div>
        
                            <div class="col-md-12 mb-3 {{ $errors->has('newPassword') ? ' has-error' : '' }}">
                              <label for="newPassword" class="col-md-3 control-label">Nova Senha</label>
                              <div class="col-md-3">
                                <input id="newPassword" type="password" class="form-control" name="newPassword" required>
                                <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
        
                                @if ($errors->has('newPassword'))
                                    <span class="help-block">
                                      <strong><font color="red">{{ $errors->first('newPassword') }}</font></strong>
                                </span>
                                @endif
                              </div>
                            </div>
        
                            <div class="col-md-12 mb-3">
                              <label for="newPasswordConfirm" class="col-md-3 control-label">Confirmação da Nova Senha</label>
                              <div class="col-md-3">
                                <input id="newPasswordConfirm" type="password" class="form-control" name="newPasswordConfirm" required>
                                <div class="invalid-feedback"><b>Campo obrigatório!</b></div>
                              </div>
                            </div>
        
                            <div class="col-md-12 mb-3">
                                <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary">
                                      Alterar Senha
                                  </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @section('script')
    
    <script language=JavaScript>
      document.FormUser.currentPassword.focus();
    </script>
     
    @endsection

@endsection
