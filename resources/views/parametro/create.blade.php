@extends('layouts.app')
@php
    $lista_alteracao = DB::table('alteracao')->get();
    $lista_categoria = DB::table('categoria')->get();
@endphp
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">{{ __('Dados do Parâmetro') }}</div>

                <div class="card-body">
                    @if(isset($objeto))
                        <form method="POST" action="{{ route('parametro.update', $objeto->id) }}">
                            {{ method_field('PUT') }}
                            @php
                                $alteracao = $objeto->ObjetivoAlteracaoParametro()->first()->Alteracao()->first();
                                $categoria_parametro = DB::table('categoria_parametro')->get()->where('fk_parametro',$objeto->id);
                                
                            //    $categoria_parametro = (array)$objeto->CategoriaParametro()->first();
                                //$categoria_parametro = array_values($categoria_parametro);
                               // dd($categoria_parametro);
                            @endphp
                    @else
                        <form method="POST" action="{{ route('parametro.store') }}">
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
                        
                        {{-- NOME --}}
                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control" name="nome" value="@if(isset($objeto)) {{ $objeto->descricao}} @endif" maxlength="45" required autofocus>

                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- ALTERACAO --}}
                        <div class="form-group row">
                            <label for="alteracao" class="col-md-4 col-form-label text-md-right">{{ __('Alteração') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="alteracao" name="alteracao" required >
                                    <option value="">Selecione...</option>
                                    @foreach ($lista_alteracao as $alteracao_select)
                                        <option value="{{$alteracao_select->id}}" @if(isset($alteracao) && $alteracao->id == $alteracao_select->id) {{ __("selected='selected'") }} @endif > {{$alteracao_select->descricao}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- UNIDADE --}}
                        <div class="form-group row">
                            <label for="unidade" class="col-md-4 col-form-label text-md-right">{{ __('Unidade de Medida') }}</label>

                            <div class="col-md-6">
                                <input id="unidade" type="text" class="form-control" name="unidade" value="@if(isset($objeto)) {{ $objeto->unidade_medida}} @endif" maxlength="10" required autofocus>

                                @if ($errors->has('unidade'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('unidade') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                
                        {{-- NUMERO REGISTRO CAS --}}
                        <div class="form-group row">
                            <label for="numero_registro_cas" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Registro CAS') }}</label>

                            <div class="col-md-6">
                                <input id="numero_registro_cas" type="text" class="form-control" name="numero_registro_cas" value="@if(isset($objeto)) {{ $objeto->numero_registro_cas}} @endif" maxlength="15" required autofocus>

                                @if ($errors->has('numero_registro_cas'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numero_registro_cas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- LIMITE CONAMA --}}
                        <div class="form-group row">
                            <label for="limite_conama" class="col-md-4 col-form-label text-md-right">{{ __('Limite CONAMA') }}</label>

                            <div class="col-md-6">
                                <input id="limite_conama" type="text" class="form-control" name="limite_conama" value="@if(isset($objeto)) {{ $objeto->limite_conama}} @endif" maxlength="10" required autofocus>

                                @if ($errors->has('limite_conama'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('limite_conama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        {{-- LIMITE OMS --}}
                        <div class="form-group row">
                            <label for="limite_oms" class="col-md-4 col-form-label text-md-right">{{ __('Limite OMS') }}</label>

                            <div class="col-md-6">
                                <input id="limite_oms" type="text" class="form-control" name="limite_oms" value="@if(isset($objeto)) {{ $objeto->limite_oms}} @endif" maxlength="45" required autofocus>

                                @if ($errors->has('limite_oms'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('limite_oms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                     
                        <div class="card">
                            <div class="card-header">{{ __('Categorias - Concentração Superior') }}</div>
                                <div class="card-body">
                                    @foreach ($lista_categoria as $chave => $categoria)
                                        <div class="form-group row">
                                            <label for="concentracao_superior" class="col-md-4 col-form-label text-md-right">{{ $categoria->qualidade }} ({{$categoria->nota}})</label>
                                           
                                            <div class="col-md-6">
                                                <input id="concentracao_superior{{$chave}}" type="text" class="form-control" name="concentracao_superior[]" value="@if(isset($categoria_parametro)) {{ $categoria_parametro[$chave*2]->concentracao_superior}} @endif" maxlength="45" required autofocus>

                                                @if ($errors->has('concentracao_superior'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('concentracao_superior') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                     
                                    @endforeach
                                </div>
                            </div>
                        </div> 
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>

                                <a class="btn btn-danger" href="{{ route('parametro.index') }}">{{ __('Cancelar') }}</a>
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
