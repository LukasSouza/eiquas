@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            <center>
                <h3>Bem vindo ao sistema E-iquas!</h3>
            </center>
        </div>

        <div class="links">
            <center>
                <a class="btn btn-primary" href="{{route('login')}}">Fazer Login</a>
                <p style="margin:15px;">Ou</p>
                <a class="btn btn-primary" href="{{route('amostra.index')}}">Fazer Análise como Convidado</a>
            </center>
        </div>
    </div>
@endsection
