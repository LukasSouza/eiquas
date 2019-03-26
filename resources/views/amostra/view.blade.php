@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            @if (!empty($parametros_obrigatorios_nao_escolhidos))
                <div class="alert alert-danger">
                   {{'Atenção! Existem parâmetros Obrigatórios para esta amostra que não foram selecionados.'}}<br>
                   {{'O resultado da Análise não será totalmente confiavel'}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Resultado da análise:') }}</div>
                <div class="card-body">
                    <center><h3>Resultado da Análise</h3></center>
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Categoria: </b></td>
                                <td>{{$categoria->descricao}}</td>
                            </tr>
                            <tr>
                                <td><b>Nota: </b></td>
                                <td>{{$categoria->nota}}</td>
                            </tr>
                            <tr>
                                <td><b>Qualidade: </b></td>
                                <td>{{$categoria->qualidade}}</td>
                            </tr>
                            <tr>
                                <td><b>Semáforo: </b></td>
                                <td>{{$categoria->semaforo}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <center><h3>Dados da Amostra</h3></center>
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Objetivo: </b></td>
                                <td>{{$objetivo->descricao}}</td>
                            </tr>
                            <tr>
                                <td><b>Atividade Preponderante: </b></td>
                                <td>{{$atividadePreponderante->descricao}}</td>
                            </tr>
                            <tr>
                                <td><b>Descrição: </b></td>
                                <td>{{$amostra->descricao}}</td>
                            </tr>
                            <tr>
                                <td><b>Ponto de Coleta: </b></td>
                                <td>{{$amostra->ponto_coleta}}</td>
                            </tr>
                            <tr>
                                <td><b>Data da Coleta: </b></td>
                                <td>{{$amostra->data_coleta}}</td>
                            </tr>
                            <tr>
                                <td><b>Condição do Tempo: </b></td>
                                <td>{{$amostra->condicao_tempo}}</td>
                            </tr>
                            <tr>
                                <td><b>Numero da Amostra: </b></td>
                                <td>{{$amostra->numero_amostra}}</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <center><h3>Parâmetros:</h3></center> --}}
                    {{-- <table>
                        <tbody>
                            @for ($i = 0; $i < sizeof($objeto->parametros); $i++)
                                <tr>
                                    <td><b>Parametro: </b></td>
                                    <td>{{$objeto->parametros_desc[$i]}}</td>
                                    <td><b>Concentração: </b></td>
                                    <td>{{$objeto->concentracao[$i]}}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table> --}}
                    <div class="container">
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <center>
                                    
                                    <a class="btn btn-primary" href="{{ route('amostra.index') }}">{{ __('Voltar') }}</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style type="text/css">
    .card {
        background-color: white;
    }
    table{
        width: 100%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;    
    }
    center h3, table{
        margin:10px;
    }
</style>
