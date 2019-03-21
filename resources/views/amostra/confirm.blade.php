@extends('layouts.app')
@php
    $objetivos = DB::table('objetivo')->get();
    $atividades_preponderantes = DB::table('atividade_preponderante')->get();
@endphp
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">{{ __('Dados da Amostra') }}</div>

                <div class="card-body">
                    @if(isset($objeto))
                        <form method="POST" action="{{ route('amostra.update', $objeto->id) }}">
                            {{ method_field('PATCH') }}
                    @else
                        <form method="POST" action="{{ route('amostra.confirm') }}">
                    @endif

                        @csrf

                        {{-- ERROS --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        {{-- OBJETIVO --}}
                        <div class="form-group row">
                            <label for="objetivo" class="col-md-4 col-form-label text-md-right">{{ __('Objetivo da Análise') }}</label>

                            <div class="col-md-6">
                                <select class="form-control objetivo" name="objetivo" required >
                                                               
                                    @foreach ($objetivos as $objetivo)
                                        <option value="{{$objetivo->id}}" > {{$objetivo->descricao}} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- ATIVIDADE PREPONDERANTE --}}
                        <div class="form-group row">
                            <label for="atividade_preponderante" class="col-md-4 col-form-label text-md-right">{{ __('Atividade Preponderante') }}</label>

                            <div class="col-md-6">
                                <select class="form-control atividade_preponderante" name="atividade_preponderante" required >
                                    <option id="selected" value="" selected="selected" >Selecione...</option>                              
                                    @foreach ($atividades_preponderantes as $atividade_preponderante)
                                        <option value="{{$atividade_preponderante->id}}" > {{$atividade_preponderante->descricao}} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        {{-- DESCRIÇÃO --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <input id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="@if(isset($objeto)) {{ $objeto->descricao}} @endif" required autofocus maxlength="45">

                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- PONTO DE COLETA --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Ponto de Coleta') }}</label>

                            <div class="col-md-6">
                                <input id="ponto_coleta" type="text" class="form-control{{ $errors->has('ponto_coleta') ? ' is-invalid' : '' }}" name="ponto_coleta" value="@if(isset($objeto)) {{ $objeto->ponto_coleta}} @endif" required autofocus maxlength="45">

                                @if ($errors->has('ponto_coleta'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ponto_coleta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- DATA DA COLETA --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Data da Coleta') }}</label>

                            <div class="col-md-6">
                                <input id="data_coleta" type="date" class="form-control{{ $errors->has('data_coleta') ? ' is-invalid' : '' }}" name="data_coleta" value="@if(isset($objeto)) {{ $objeto->data_coleta}} @endif" required autofocus>

                                @if ($errors->has('data_coleta'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('data_coleta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- CONDIÇÃO DO TEMPO --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Condição Climática') }}</label>

                            <div class="col-md-6">
                                <input id="condicao_tempo" type="text" class="form-control{{ $errors->has('condicao_tempo') ? ' is-invalid' : '' }}" name="condicao_tempo" value="@if(isset($objeto)) {{ $objeto->condicao_tempo}} @endif" required autofocus maxlength="45">

                                @if ($errors->has('condicao_tempo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('condicao_tempo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- NUMERO DA AMOSTRA --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Numero da Amostra') }}</label>

                            <div class="col-md-6">
                                <input id="numero_amostra" type="text" class="form-control{{ $errors->has('numero_amostra') ? ' is-invalid' : '' }}" name="numero_amostra" value="@if(isset($objeto)) {{ $objeto->numero_amostra }} @endif" required autofocus maxlength="45">

                                @if ($errors->has('numero_amostra'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numero_amostra') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Continuar') }}
                                </button>

                                <a class="btn btn-danger" href="{{ route('amostra.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </div>
                    </form>
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
</style>
