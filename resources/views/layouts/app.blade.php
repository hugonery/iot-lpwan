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

    @yield('head')

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}" type="text/css">
</head>
<body @if ( (strpos(url()->full(),'/users') > 0) || (strpos(url()->full(),'/places') > 0) || (strpos(url()->full(),'/stations') > 0) || (strpos(url()->full(),'/sensors') > 0) || (strpos(url()->full(),'/changePassword') > 0) ) class="navigation-toggle-one" @else class="@yield('bodyClass')" @endif>

<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->

<!-- begin::header -->
<div class="header">

    <div>
        <ul class="navbar-nav">

            <!-- begin::navigation-toggler -->
            <li class="nav-item navigation-toggler">
                <a href="#" class="nav-link" title="Hide navigation">
                    <i data-feather="arrow-left"></i> menu
                </a>
            </li>
            <li class="nav-item navigation-toggler mobile-toggler">
                <a href="#" class="nav-link" title="Show navigation">
                    <i data-feather="menu"></i>
                </a>
            </li>
            <!-- end::navigation-toggler -->

        </ul>
    </div>

    <div>
        <ul class="navbar-nav">

            <!-- begin::user menu -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" title="Configurações" data-toggle="dropdown">
                    <i class="fa fa-cog fa-2x" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                    <div class="p-4 text-center d-flex justify-content-between"
                         data-backround-image="{{ url('assets/media/image/image1.jpg') }}">
                        <h6 class="mb-0">{{ auth()->user()->name  }}</h6>
                    </div>
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="custom-control custom-switch">
                                    <i class="fa fa-user-o fa-lg" aria-hidden="true"></i> <a href="/changePassword" class="btn bg-white">Alterar Senha</a>
                                </div>
                                <div class="custom-control custom-switch">
                                    <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> <a href="/logout" class="btn bg-white">Sair do Sistema</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- end::user menu -->
        </ul>

        <!-- begin::mobile header toggler -->
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item header-toggler">
                <a href="#" class="nav-link">
                    <i data-feather="arrow-down"></i>
                </a>
            </li>
        </ul>
        <!-- end::mobile header toggler -->
    </div>

</div>
<!-- end::header -->

<!-- begin::main -->
<div id="main">

    <!-- begin::navigation -->
    <div class="navigation">

        <div class="navigation-menu-tab">
            <div>
                <div class="navigation-menu-tab-header" data-toggle="tooltip" data-placement="right">
                        <br>
                </div>
            </div>
            <div class="flex-grow-1">
                <ul>
                    <li>
                        <a @if (strpos(url()->full(),'home') > 0) class="active" @endif href="/home" data-toggle="tooltip" data-placement="right" title="Home" data-nav-target="#home">
                            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a @if (strpos(url()->full(),'users') > 0) class="active" @endif href="#" data-toggle="tooltip" data-placement="right" title="Clientes" data-nav-target="#clientes">
                            <i class="fa fa-address-book-o fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a @if (strpos(url()->full(),'places') > 0) class="active" @endif href="#" data-toggle="tooltip" data-placement="right" title="Propriedades" data-nav-target="#propriedades">
                            <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a @if (strpos(url()->full(),'stations') > 0) class="active" @endif href="#" data-toggle="tooltip" data-placement="right" title="Estações" data-nav-target="#estacoes">
                            <i class="fa fa-wifi fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a @if (strpos(url()->full(),'sensors') > 0) class="active" @endif href="#" data-toggle="tooltip" data-placement="right" title="Sensores" data-nav-target="#sensores">
                            <i class="fa fa-thermometer-half fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <a href="/logout" data-toggle="tooltip" data-placement="right" title="Sair do Sistema">
                            <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- begin::navigation menu -->
        <div class="navigation-menu-body">

            <!-- begin::navigation-logo -->
            <div>
                <div id="navigation-logo">
                    <a href="{{ url('/') }}">
                        <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="logo">
                        <img class="logo-light" src="{{ url('assets/media/image/logo-light.png') }}" alt="light logo">
                    </a>
                </div>
            </div>
            <!-- end::navigation-logo -->

            <div class="navigation-menu-group">

                <div @if ( (strpos(url()->full(),'places')==false) && (strpos(url()->full(),'stations')==false) && (strpos(url()->full(),'sensors')==false) ) class="open" @endif id="clientes">
                    <ul>
                        <li class="navigation-divider"><i class="fa fa-address-book-o fa-lg" aria-hidden="true"></i> Clientes</li>
                        <li><a href="/users/create">Cadastrar</a></li>
                        <li><a href="/users">Consultar</a></li>
                    </ul>
                </div>

                <div @if (strpos(url()->full(),'places') > 0) class="open" @endif id="propriedades">
                    <ul>
                        <li class="navigation-divider"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Propriedades</li>
                        <li><a href="/places">Consultar</a></li>
                    </ul>
                </div>

                <div @if (strpos(url()->full(),'stations') > 0) class="open" @endif id="estacoes">
                    <ul>
                        <li class="navigation-divider"><i class="fa fa-wifi fa-lg" aria-hidden="true"></i> Estações</li>
                        <li><a href="/stations">Consultar</a></li>
                    </ul>
                </div>

                <div @if (strpos(url()->full(),'sensors') > 0) class="open" @endif id="sensores">
                    <ul>
                        <li class="navigation-divider"><i class="fa fa-thermometer-half fa-lg" aria-hidden="true"></i> Sensores</li>
                        <li><a href="/sensors">Consultar</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- end::navigation menu -->

    </div>
    <!-- end::navigation -->

    <!-- begin::main-content -->
    <div class="main-content">

        @yield('content')

        <!-- begin::footer -->
        <footer>
            <div class="container-fluid">
                <h1>Copyright © {{ date('Y') }} IoT LPWAN</h1>
            </div>
        </footer>
        <!-- end::footer -->

    </div>
    <!-- end::main-content -->

</div>
<!-- end::main -->

<!-- Plugin scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

@yield('script')

<!-- App scripts -->
<script src="{{ url('assets/js/app.js') }}"></script>

</body>
</html>