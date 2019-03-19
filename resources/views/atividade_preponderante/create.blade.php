@extends('layouts.app')
@php
    $parametros = DB::table('parametro')->get();
@endphp
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">{{ __('Dados da Atividade Preponderante') }}</div>

                <div class="card-body">
                    @if(isset($objeto))
                        <form method="POST" action="{{ route('atividade_preponderante.update', $objeto->id) }}">
                            {{ method_field('PATCH') }}
                    @else
                        <form method="POST" action="{{ route('atividade_preponderante.store') }}">
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
                                <input id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="@if(isset($objeto)) {{ $objeto->descricao}} @endif" maxlength="45" required autofocus>

                                @if ($errors->has('descricao'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">{{ __('Parâmetros Obrigatórios') }}</div>
                                <div class="card-body">
                                        <button type="button" class="btn btn-primary circular" id="mais">+</button>
                                        <button type="button" class="btn btn-danger circular" id="menos">-</button>
                                    <div class="form-group row content-param" id="body-param">
                                        <div id="content-param">
                                            <label for="parametros" id='label-param' class="col-md-4 col-form-label text-md-right">Parametro 1</label>
                                            
                                            <div class="col-md-6">
                                                <select class="form-control parametros" name="parametros[]" required >
                                                    <option id="selected" value="" selected="selected" >Selecione...</option>
                                                    @foreach ($parametros as $parametro)
                                                        <option value="{{$parametro->id}}" @if(isset($objeto) && $objeto->AtividadeParametroMinimo()->fk_parametro == $parametro->id) {{ __("selected='selected'") }} @endif > {{$parametro->descricao}} </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('parametros'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('parametros') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>

                                <a class="btn btn-danger" href="{{ route('atividade_preponderante.index') }}">{{ __('Cancelar') }}</a>
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
        .card {
            background-color: white;
        }
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
           

            $('#mais').on('click',function(e){
                if(contador < total){ 
                    $('#body-param').last().append(existingdiv1);
                    contador++;
                    $('#label-param').last().html('Parâmetro '+contador);
                    ocultarOpcaoSelecionada('.parametros');
                }
                else
                    alert('Numero máximo de Parâmetros')
            });

            $('#menos').on('click',function(e){
                if(contador > 1){
                    $('#content-param:last-child').remove();
                    contador--;
                    $('#label-param').html('Parâmetro '+contador);
                    ocultarOpcaoSelecionada('.parametros');
                }
                else
                    alert('Mínimo de um parâmetro obrigatorio para o cadastro!')
            });

            $('.parametros').each(function(){
                $(document).on('change', '.parametros', function(){
                    ocultarOpcaoSelecionada('.parametros');
                });
            });

            const ocultarOpcaoSelecionada = function(selector) {
                var array = JSON.parse( parametros.replace(/&quot;/g, '"') ); //Transformar em Array e retirar marcações $quot;
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

            const retornaValoresSelecionados = function(selector) {
                let array = new Array;
                $(selector).each(function (indexInArray, valueOfElement) { 
                    array.push( $(valueOfElement).val() );
                });
                return array;
            }
            
        });
    </script>
@endsection
