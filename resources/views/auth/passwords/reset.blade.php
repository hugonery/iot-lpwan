<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}" type="text/css">
</head>
<body class="form-membership" style="background-image: url({{asset('assets/media/image/photo-wide-1.jpg')}})">

<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->

<div class="form-wrapper">

    <!-- logo -->
    <div id="logo">
        <a href="/"><img class="logo" src="{{ url('assets/media/image/logo-login.png') }}" alt="image"></a>
        <img class="logo-dark" src="{{ url('assets/media/image/logo-dark.png') }}" alt="image">
    </div>
    <!-- ./ logo -->

    <h5>{{ __('Formulário de Redefinição de Senha') }}</h5>

    <!-- form -->
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
		
        <input type="hidden" name="token" value="{{ $token }}">
		
        <div class="form-group">
            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
			@if ($errors->has('email'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
        </div>
		<div class="form-group">
            <input id="password" placeholder="Senha" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
			@if ($errors->has('password'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
        </div>
		<div class="form-group">
            <input id="password-confirm" placeholder="Confirmação da Senha" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <button class="btn btn-primary ladda-button btn-block example-button" type="submit" onclick = 'this.form.submit();' data-style="expand-left"><span class="ladda-label">{{ __('Criar Nova Senha') }}</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
    </form>
    <!-- ./ form -->

</div>

<!-- Plugin scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

<!-- App scripts -->
<script src="{{ url('assets/js/app.js') }}"></script>
</body>
</html>
