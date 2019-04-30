@extends('layouts.app')
@php
    $lista_alteracao = DB::table('alteracao')->orderBy('descricao')->get();
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
                        <form id="formulario" method="POST" action="{{ route('parametro.update', $objeto->id) }}">
                            {{ method_field('PUT') }}
                            @php
                                $alteracao = $objeto->ObjetivoAlteracaoParametro()->first()->Alteracao()->first();
                                $categoria_parametro = DB::table('categoria_parametro')->get()->where('fk_parametro',$objeto->id);
                                $categoria_parametro = $categoria_parametro->values();


                            //    $categoria_parametro = (array)$objeto->CategoriaParametro()->first();
                                //$categoria_parametro = array_values($categoria_parametro);
                                //dd($categoria_parametro);
                            @endphp
                    @else
                        <form id="formulario" method="POST" action="{{ route('parametro.store') }}">
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
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome*') }}</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control" name="nome" value="@if(isset($objeto)){{$objeto->descricao}}@endif" maxlength="45" required autofocus>

                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- ALTERACAO --}}
                        <div class="form-group row">
                            <label for="alteracao" class="col-md-4 col-form-label text-md-right">{{ __('Alteração*') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="alteracao" name="alteracao" required >
                                    <option value="">Selecione...</option>
                                    @foreach ($lista_alteracao as $alteracao_select)
                                        <option value="{{$alteracao_select->id}}" @if(isset($alteracao) && $alteracao->id == $alteracao_select->id){{ __("selected='selected'") }}@endif >{{$alteracao_select->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {!!showHelper('Natureza da alteração que o parâmetro produz na qualidade da água')!!}
                        </div>

                        {{-- UNIDADE --}}
                        <div class="form-group row">
                            <label for="unidade" class="col-md-4 col-form-label text-md-right">{{ __('Unidade de Medida*') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="unidade" name="unidade" required >
                                    <option value="">Selecione...</option>
                                    <option value="μg/l" @if(isset($objeto) && $objeto->unidade_medida == 'μg/l'){{ __("selected='selected'") }}@endif >μg/l</option>
                                    <option value="mg/L" @if(isset($objeto) && $objeto->unidade_medida == 'mg/L'){{ __("selected='selected'") }}@endif >mg/L</option>
                                    <option value="UNT" @if(isset($objeto) && $objeto->unidade_medida == 'UNT'){{ __("selected='selected'") }}@endif >UNT</option>
                                    <option value="cel/mL" @if(isset($objeto) && $objeto->unidade_medida == 'cel/mL'){{ __("selected='selected'") }}@endif >cel/mL</option>
                                    <option value="mm³/L" @if(isset($objeto) && $objeto->unidade_medida == 'mm³/L'){{ __("selected='selected'") }}@endif >mm³/L</option>
                                    <option value="ESCALA" @if(isset($objeto) && $objeto->unidade_medida == 'ESCALA'){{ __("selected='selected'") }}@endif >ESCALA</option>
                                    <option value="P/A" @if(isset($objeto) && $objeto->unidade_medida == 'P/A'){{ __("selected='selected'") }}@endif >P/A</option>
                                </select>

                                @if ($errors->has('unidade'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('unidade') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {!!showHelper('Unidade na qual o teor do parâmetro será informado')!!}
                        </div>

                        {{-- NUMERO REGISTRO CAS --}}
                        <div class="form-group row">
                            <label for="numero_registro_cas" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Registro CAS*') }}</label>

                            <div class="col-md-6">
                                <input id="numero_registro_cas" type="text" class="form-control" name="numero_registro_cas" value="@if(isset($objeto)){{$objeto->numero_registro_cas}}@endif" maxlength="15" required autofocus>

                                @if ($errors->has('numero_registro_cas'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numero_registro_cas') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {!!showHelper('Chemical Abstracts Service Number')!!}
                        </div>

                        {{-- LIMITE CONAMA --}}
                        <div class="form-group row">
                            <label for="limite_conama" class="col-md-4 col-form-label text-md-right">{{ __('Limite CONAMA') }}</label>

                            <div class="col-md-6">
                                <input id="limite_conama" type="text" class="form-control decimal" name="limite_conama" value="@if(isset($objeto)){{$objeto->limite_conama}}@endif" maxlength="10" autofocus>

                                @if ($errors->has('limite_conama'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('limite_conama') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {!!showHelper('Valor máximo permitido (VMP) pelo CONAMA no uso preponderante para consumo humano')!!}
                        </div>

                        {{-- LIMITE OMS --}}
                        <div class="form-group row">
                            <label for="limite_oms" class="col-md-4 col-form-label text-md-right">{{ __('Limite OMS') }}</label>

                            <div class="col-md-6">
                                <input id="limite_oms" type="text" class="form-control decimal" name="limite_oms" value="@if(isset($objeto)){{$objeto->limite_oms}}@endif" maxlength="45"  autofocus>

                                @if ($errors->has('limite_oms'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('limite_oms') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {!!showHelper('Valor de referência sugerido pela Organização Mudial de Saúde')!!}
                        </div>

                        {{-- CATEGORIAS --}}
                        <div class="card">
                            <div class="card-header">{{ __('Categorias - Concentração Superior') }} {!!showHelper('As categorias definem a nota a ser atribuída ao parâmetro, de acordo com o teor da substância na amostra.')!!}</div>
                                <div class="card-body">
                                    @php
                                        $mensagens =
                                        [
                                            'Teor do parâmetro abaixo do qual a água pode ser considerada ÓTIMA',
                                            'Teor do parâmetro, acima da concentração ótima, e abaixo do qual a água pode ser considerada BOA',
                                            'Teor do parâmetro, acima da concentração boa, e abaixo do qual a água pode ser considerada REGULAR',
                                            'Teor do parâmetro, acima do qual a água pode ser considerada RUIM'
                                        ];
                                    @endphp
                                    @foreach ($lista_categoria as $chave => $categoria)
                                        <div class="form-group row">
                                            <label for="concentracao_superior" class="col-md-4 col-form-label text-md-right">{{ $categoria->qualidade }} ({{$categoria->nota}})*</label>

                                            <div class="col-md-6">
                                                <input id="concentracao_superior{{$chave}}" type="text" class="form-control decimal concentracao_superior" name="concentracao_superior[]" value="@if(isset($categoria_parametro)){{$categoria_parametro[$chave]->concentracao_superior}}@endif" maxlength="11" required autofocus>

                                                @if ($errors->has('concentracao_superior'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('concentracao_superior') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            {!!showHelper($mensagens[$chave])!!}
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" id="submit_button">
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

@section('pagescript')
<script>
$('[data-toggle="tooltip"]').tooltip();
    function verificarConcentracoes(vetor){
        for(var i = 1; i < vetor.length; i++){
            if( parseFloat(vetor[i]) <= parseFloat(vetor[i-1]) )
                return false;
        }
        return true;
    }

    $("#submit_button").on("click", function(){
        var concentracoes = new Array();
        $('.concentracao_superior').each(function(){
            concentracoes.push($(this).val());
        });

        if(verificarConcentracoes(concentracoes))
            $("#formulario").submit();
        else
            alert('O valor das concentrações Superiores devem ser maiores gradativamente');
    });
</script>
@endsection
