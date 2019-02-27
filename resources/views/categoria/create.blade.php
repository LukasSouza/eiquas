@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">{{ __('Dados da Categoria') }}</div>

                <div class="card-body">
                    @if(isset($objeto))
                        <form method="POST" action="{{ route('categoria.update', $objeto->id) }}">
                            {{ method_field('PATCH') }}
                    @else
                        <form method="POST" action="{{ route('categoria.store') }}">
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

                        {{-- DESCRICAO --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <input id="descricao" type="text" class="form-control" name="descricao" value="@if(isset($objeto)) {{ $objeto->descricao}} @endif" maxlength="80" required autofocus>

                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- NOTA --}}
                        <div class="form-group row">
                            <label for="nota" class="col-md-4 col-form-label text-md-right">{{ __('Nota') }}</label>

                            <div class="col-md-6">
                                <input id="nota" type="text" class="form-control" name="nota" value="@if(isset($objeto)) {{ $objeto->nota}} @endif" maxlength="11" required autofocus>

                                @if ($errors->has('nota'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nota') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- QUALIDADE --}}
                        <div class="form-group row">
                            <label for="qualidade" class="col-md-4 col-form-label text-md-right">{{ __('Qualidade') }}</label>

                            <div class="col-md-6">
                                <input id="qualidade" type="text" class="form-control" name="qualidade" value="@if(isset($objeto)) {{ $objeto->qualidade}} @endif" maxlength="10" required autofocus>

                                @if ($errors->has('qualidade'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('qualidade') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- SEMAFORO --}}
                        <div class="form-group row">
                            <label for="semaforo" class="col-md-4 col-form-label text-md-right">{{ __('Semáforo') }}</label>

                            <div class="col-md-6">
                                <input id="semaforo" type="text" class="form-control" name="semaforo" value="@if(isset($objeto)) {{ $objeto->semaforo}} @endif" maxlength="10" required autofocus>

                                @if ($errors->has('semaforo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('semaforo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>

                                <a class="btn btn-danger" href="{{ route('categoria.index') }}">{{ __('Cancelar') }}</a>
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
