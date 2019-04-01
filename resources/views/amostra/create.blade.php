@extends('layouts.app')
@php
    $objetivos = DB::table('objetivo')->orderBy('descricao')->get();
    $parametros = DB::table('parametro')->orderBy('descricao')->get();
    $atividades_preponderantes = DB::table('atividade_preponderante')->orderBy('descricao')->get();
@endphp
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 py-5">
            @if(isset($objeto))
            <form method="POST" action="{{ route('amostra.update', $objeto->id) }}">
                {{ method_field('PATCH') }}
            @else
                <form method="POST" action="{{ route('amostra.confirm') }}">
            @endif
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Dados da Amostra') }}</div>

                    <div class="card-body">
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
                            <label for="objetivo" class="col-md-4 col-form-label text-md-right">{{ __('Objetivo da Avaliação') }}</label>

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
                                        <option value="{{$atividade_preponderante->id}}" >{{$atividade_preponderante->descricao}}</option>
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
                                <input id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="@if(isset($objeto)){{$objeto->descricao}}@endif" required autofocus maxlength="45">

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
                                <input id="ponto_coleta" type="text" class="form-control{{ $errors->has('ponto_coleta') ? ' is-invalid' : '' }}" name="ponto_coleta" value="@if(isset($objeto)){{$objeto->ponto_coleta}}@endif" required autofocus maxlength="45">

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
                                <input id="data_coleta" type="date" class="form-control{{ $errors->has('data_coleta') ? ' is-invalid' : '' }}" name="data_coleta" value="@if(isset($objeto)){{$objeto->data_coleta}}@endif" required autofocus>

                                @if ($errors->has('data_coleta'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('data_coleta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- CONDIÇÃO DO TEMPO --}}
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Condição do Tempo') }}</label>

                            <div class="col-md-6">
                                <select class="form-control condicao_tempo" name="condicao_tempo" required >
                                    <option value="">Selecione...</option>
                                    <option value="Ensolarado" @if(isset($objeto) && $objeto->condicao_tempo == 'Ensolarado'){{ __("selected='selected'") }}@endif >Ensolarado</option>
                                    <option value="Nublado sem chuvas" @if(isset($objeto) && $objeto->condicao_tempo == 'Nublado sem chuvas'){{ __("selected='selected'") }}@endif >Nublado sem chuvas</option>
                                    <option value="Chuvoso" @if(isset($objeto) && $objeto->condicao_tempo == 'Chuvoso'){{ __("selected='selected'") }}@endif >Chuvoso</option>
                                </select>
                                
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
                                <input id="numero_amostra" type="text" class="form-control decimal {{ $errors->has('numero_amostra') ? ' is-invalid' : '' }}" name="numero_amostra" value="@if(isset($objeto)){{$objeto->numero_amostra}}@endif" required autofocus maxlength="45">

                                @if ($errors->has('numero_amostra'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numero_amostra') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         {{-- PARAMETROS --}}
                            
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Parâmetros Para Análise') }}</div>
                    <div class="card-body">
                            <button type="button" class="btn btn-primary circular" id="mais">+</button>
                            <button type="button" class="btn btn-danger circular" id="menos">-</button>
                        <div class="form-group row content-param" id="body-param">
                            <div id="content-param">
                                <label for="parametros" id='label-param' class="col-md-2 col-form-label text-md-right">Parametro</label>
                                
                                <div class="col-md-4">
                                    <select class="form-control parametros" name="parametros[]" required >
                                        <option id="selected" value="" selected="selected" >Selecione...</option>
                                    
                                        @foreach ($parametros as $parametro)
                                            <option value="{{$parametro->id}}" >{{$parametro->descricao}} ({{$parametro->unidade_medida}})</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('parametros'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('parametros') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label for="concentracao" id='label-param' class="col-md-2 col-form-label text-md-right">Concentração</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control decimal {{ $errors->has('numero_amostra') ? ' is-invalid' : '' }}" name="concentracao[]" value="@if(isset($objeto)){{$objeto->numero_amostra}}@endif" required autofocus maxlength="11">

                                    @if ($errors->has('concentracao'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('concentracao') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="container">
                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <center>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Continuar') }}
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
@endsection

@section('pagestyle')
    <style type="text/css">
        button.circular{
            border-radius: 50%;
        }
        #content-param div{
            display: inline-block;
        }
        #content-param{
            width: 100%;
        }
        #selected{
            display: block !important;
        }
    </style>
@endsection


@section('pagescript')
    <script>
        $(document).ready(function(){
            var existingdiv1 = $( "#body-param" ).html();
            var contador = 1;
            var total = {{sizeof($parametros)}};
            var parametros = '{{$parametros}}';

            var total_parametros = $("#total_parametros").val();
            
            //Tela UPDATE
            if(total_parametros > 0){
                var AtividadeParametroMinimo;
                @if(isset($objeto))
                    AtividadeParametroMinimo = phpToJs("{{$objeto->AtividadeParametroMinimo}}");
                @endif
                
                for(i = 1; i < total_parametros; i++){
                    botao_mais();
                }
                var count = 0;
                $('.parametros').each(function(){
                    $(this).val(AtividadeParametroMinimo[count].fk_parametro);
                    count++;
                    ocultarOpcaoSelecionada('.parametros');
                });
                
            }

            document.getElementById("mais").addEventListener ("click", botao_mais, false);
            document.getElementById("menos").addEventListener ("click", botao_menos, false); 

            $('.parametros').each(function(){
                $(document).on('change', '.parametros', function(){
                    ocultarOpcaoSelecionada('.parametros');
                });
            });

            function botao_mais(){
                if(contador < total){ 
                    $('#body-param').last().append(existingdiv1);
                    contador++;
                    ocultarOpcaoSelecionada('.parametros');
                }
                else
                    alert('Numero máximo de Parâmetros');
            }
            function botao_menos(){
                if(contador > 1){
                    $('#content-param:last-child').remove();
                    contador--;
                    ocultarOpcaoSelecionada('.parametros');
                }
                else
                    alert('Mínimo de um parâmetro obrigatorio para o cadastro!');
            }

            function ocultarOpcaoSelecionada(selector) {
                var array = phpToJs(parametros); //Transformar em Array e retirar marcações $quot;
                array = $.map(array, function(val){return String(val.id);}); //Pegar apenas o ID do objeto
                array = array.filter( (value) => { return !retornaValoresSelecionados(selector).includes(value); } );
                // console.log(array);
                $(selector +' option').each(function(){
                    if( !array.includes( $(this).val() ) )
                        $(this).css('display', 'none');
                    else
                        $(this).css('display', 'block');
                });
            }

            function retornaValoresSelecionados(selector) {
                let array = new Array;
                $(selector).each(function (indexInArray, valueOfElement) { 
                    array.push( $(valueOfElement).val() );
                });
                return array;
            }

            function phpToJs(phpArray) {
                return JSON.parse( phpArray.replace(/&quot;/g, '"') );
            }
            
            
        });
    </script>
@endsection