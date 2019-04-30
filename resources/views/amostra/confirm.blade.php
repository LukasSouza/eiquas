@extends('layouts.app')
@php
    $objeto = (object)$objeto;
    $alerta = 'Atenção! Existem parâmetros Obrigatórios para esta amostra que não foram selecionados.<br>O resultado da Análise não será totalmente confiavel';
    $analise_confiavel = 1;
    $fk_user = null;

    if(!empty($parametros_obrigatorios_nao_escolhidos)){
        $analise_confiavel = 0;
    }
 
@endphp

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            @if (!empty($parametros_obrigatorios_nao_escolhidos))
                <div class="alert alert-danger">
                   {{$alerta}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Confirmar dados para análise:') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('amostra.store') }}">
                        @csrf
                        <input type="hidden" name="array" value="{{serialize($objeto)}}">
                        <input type="hidden" name="analise_confiavel" value="{{$analise_confiavel}}">
                        <input type="hidden" name="fk_user" value="{{Auth::id()}}">
                        <input type="hidden" name="parametros_obrigatorios_nao_escolhidos" value="@if(!empty($parametros_obrigatorios_nao_escolhidos)){{$alerta}}@endif">
                        <center><h3>Dados da Amostra</h3></center>
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Objetivo: </b></td>
                                    <td>{{$objeto->objetivo_desc}}</td>
                                </tr>
                                <tr>
                                    <td><b>Atividade Preponderante: </b></td>
                                    <td>{{$objeto->atividade_preponderante_desc}}</td>
                                </tr>
                                <tr>
                                    <td><b>Descrição: </b></td>
                                    <td>{{$objeto->descricao}}</td>
                                </tr>
                                <tr>
                                    <td><b>Ponto de Coleta: </b></td>
                                    <td>{{$objeto->ponto_coleta}}</td>
                                </tr>
                                <tr>
                                    <td><b>Data da Coleta: </b></td>
                                    <td>{{$objeto->data_coleta}}</td>
                                </tr>
                                <tr>
                                    <td><b>Condição do Tempo: </b></td>
                                    <td>{{$objeto->condicao_tempo}}</td>
                                </tr>
                                <tr>
                                    <td><b>Numero da Amostra: </b></td>
                                    <td>{{$objeto->numero_amostra}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <center><h3>Parâmetros:</h3></center>
                        <table>
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
                        </table>
                        <div class="container">
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <center>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Confirmar') }}
                                        </button>
        
                                        <a class="btn btn-danger" href="{{ route('amostra.index') }}">{{ __('Cancelar') }}</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagestyle')
    <style type="text/css">
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
@endsection
