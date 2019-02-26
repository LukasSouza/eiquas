@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">{{ __('Dados da Alteração') }}</div>

                <div class="card-body">
                    @if(isset($objeto))
                        <form method="POST" action="{{ route('alteracao.update', $objeto->id) }}">
                            {{ method_field('PATCH') }}
                    @else
                        <form method="POST" action="{{ route('alteracao.store') }}">
                    @endif

                        @csrf

                        {{-- ERROS --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                     <li>   {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- NOME --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <input id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="@if(isset($objeto)) {{ $objeto->descricao}} @endif" required autofocus>

                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>

                                <a class="btn btn-danger" href="{{ route('alteracao.index') }}">{{ __('Cancelar') }}</a>
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
