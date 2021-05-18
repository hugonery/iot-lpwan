<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="">
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

    <!-- form -->
   <form method="POST" action="{{ route('login') }}">
		@csrf
		
		@switch(@$erro)
			@case(1)
				<h5 class='mb-2'><font color='red'><b>Email não reconhecido!</b></font></h5><hr>
			@break
			@case(2)
				<h5 class='mb-2'><font color='red'><b>Acesso restrito!</b></font></h5><hr>
			@break
			@case(3)
				<h5 class='mb-2'><font color='red'><b>Email ou senha inválidos!</b></font></h5><hr>
			@break
			@case(4)
				<h5 class='mb-2'><font color='red'><b>Você saiu do sistema com segurança</b></font></h5><hr>
			@break
			@case(5)
				<h5 class='mb-2'><font color='red'><b>Erro no reCAPTCHA</b></font></h5><hr>
			@break
		@endswitch
		
		<h5>Acesso ao Sistema</h5>
		
        <div class="form-group">
            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
            <div class="g-recaptcha text-center btn" data-sitekey="6LecGBkTAAAAANuo1latvsWKxls47EnMMyuMLXAn"></div>
        </div>
		
        <button class="btn btn-primary btn-block">Acessar</button>
        <a href="{{ route('password.request') }}" class="btn btn-secondary btn-block mt-2">Esqueci a senha</a>
		
    </form>
    <!-- ./ form -->

</div>

<!-- Plugin scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

<!-- App scripts -->
<script src="{{ url('assets/js/app.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
