<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
</head>
<style media="screen">
    #wrapper{
        margin-top: 53px;
    }
    #divCabecalho a{
        margin-right: 25px;
    }
    .card {
        background-color: white;
    }
    body{
        font-size: 1rem !important;
    }
    .navbar-expand-md .navbar-nav .nav-link {
        padding-right: 1rem;
        padding-left: 1rem;
    }

    .helper{
        padding: 0px;
        display: inline-block;
    }
    .helper i{
        vertical-align: middle;
        vertical-align: -webkit-baseline-middle;
    }
    footer div{
        box-shadow: 0 -1px 6px rgb(0, 0, 0, 0.3);
        padding: 15px 0px;
    }
     footer div{
        text-align: center
    }
    footer div img{
        margin: 0px 10px;
    }
    footer .navbar-laravel{
        padding: 0px;
    }
</style>
@yield('pagestyle')
<body id="test2">
    <div id="app">
        <nav class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 navbar navbar-expand-md navbar-light navbar-laravel fixed-top" >
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('images/eiquas.png')}}" alt="E-IQUAS" width="70"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @auth
                                <a class="dropdown-item" href="{{ route('alteracao.index') }}">Alteração</a>
                                <a class="dropdown-item" href="{{ route('categoria.index') }}">Categoria</a>
                            @endauth
                            <a class="dropdown-item" href="{{ route('parametro.index') }}">Parametro</a>
                            <a class="dropdown-item" href="{{ route('atividade_preponderante.index') }}">Atividade Preponderante</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('amostra.index') }}">Análise de Amostras</a></li>
                    @auth
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('amostra.index') }}">Usuarios</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Novo Usuário</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="dropdown-item" type="submit">Sair</button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <div id="wrapper" class="toggleda">
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid py-5">
                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>

</body>

<footer>
    <div class="navbar-expand-md navbar-light navbar-laravel fixed-bottom" >
        <div>
            <img src="{{asset('images/nusol.png')}}" alt="" class="img-responsive" width="60" >
            <img src="{{asset('images/onda_digital.png')}}" alt="" class="img-responsive" width="130">
        </div>
    </div>
</footer>

<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://code.jquery.com/ui/1.8.5/jquery-ui.min.js" integrity="sha256-fOse6WapxTrUSJOJICXXYwHRJOPa6C1OUQXi7C9Ddy8=" crossorigin="anonymous"></script>


@yield('pagescript')
</html>