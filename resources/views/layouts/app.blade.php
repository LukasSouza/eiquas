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
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<style media="screen">
    #wrapper{
        margin-top: 53px;
    }
</style>

<body id="test2">
    <div id="app">
        <nav class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 navbar navbar-expand-md navbar-light navbar-laravel fixed-top" >
            <div class="container-fluid">

                <div class="col-8" id="divCabecalho">

                    <a class="navbar-brand" href="{{ url('/home') }}">
                         E-IQUAS
                    </a>
                    <a style="margin-right:20px;" href="{{ route('alteracao.index') }}">Alteração</a>
                    <a style="margin-right:20px;" href="{{ route('amostra.index') }}">Amostra</a>
                    <a style="margin-right:20px;" href="{{ route('atividade_preponderante.index') }}">Atividade Preponderante</a>
                    <a style="margin-right:20px;" href="{{ route('categoria.index') }}">Categoria</a>
                    <a style="margin-right:20px;" href="{{ route('objetivo.index') }}">Objetivo</a>
                    <a style="margin-right:20px;" href="{{ route('parametro.index') }}">Parametro</a>
                </div>
                <div class="col-1">
                    {{-- <span id="menu-button" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> --}}
                </div>
            </div>
        </nav>

        <div id="wrapper" class="toggleda">
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid py-3">
                    {{-- <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> --}}
                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>

        </div>

    </div>


</body>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.maskMoney.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/vue.js') }}"></script> --}}
    @yield('pagescript')
</html>
