 @extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 py-5">
            @if (!empty($parametros_obrigatorios_nao_escolhidos))
                <div class="alert alert-danger">
                   {{'Atenção! Existem parâmetros Obrigatórios para esta amostra que não foram selecionados.'}}<br>
                   {{'O resultado da Análise não será totalmente confiavel'}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Resumo da análise:') }}</div>
                <div class="card-body">
                    <center><h3>Índice de Qualidade da Água (E-IQUAS)</h3></center>
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="6"><b>Amostra: </b>{{$amostra->numero_amostra}}</td>
                                <td colspan="6"><b>Data da Coleta: </b>{{converterData($amostra->data_coleta)}}</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>Ponto de Coleta: </b>{{$amostra->ponto_coleta}}</td>
                                <td colspan="6"><b>Condição do Tempo: </b>{{$amostra->condicao_tempo}}</td>
                            </tr>
                            <tr>
                                <td colspan="12"><b>Atividade Preponderante: </b>{{$atividadePreponderante->descricao}}</td>
                            </tr>
                            <tr>
                                <td colspan="12"><b>Descrição: </b>{{$amostra->descricao}}</td>
                            </tr>
                            <tr>
                                <td colspan="12"><b>Objetivo da Avaliação: </b>{{$objetivo->descricao}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <center><h3>Grupo Modificador de Qualidade: </h3></center>
                    <table>
                        <tbody>
                            @foreach ($alteracoes as $alteracao)
                                <tr>
                                    <td><b>{{$alteracao->descricao}}: </b></td>
                                    <td>@if(isset($alteracao->nota)){{$alteracao->nota}}@else Não Avaliado @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <center><h3>Resultado: </h3></center>
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="6"><b>Indice de Qualidade da Água (E-IQUAS): </b></td>
                                <td colspan="6">{{$categoria->nota}}</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>Indica que a amostra está:</b></td>
                                <td colspan="6">{{$categoria->qualidade}}</td>
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
