@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2>Parâmetros</h2>
    <p class="separator"></p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTable" aria-describedby="users_table" role="grid">
            <thead>
    			<tr>
                    <th>Alteração</th>
                    <th>Nome</th>
                    <th>Unidade</th>
                    <th>Numero do Registro CAS</th>
                    <th>Limite CONAMA</th>
                    <th>Limite OMS</th>
                    <th>Opções</th>
                </tr>
    		</thead>
    		<tbody>
                @foreach ($objetos as $obj)
                    @php
                        $alteracao = $obj->ObjetivoAlteracaoParametro()->first()->Alteracao()->first();
                    @endphp
                    <tr role="row" class="odd">
                        <td>{{$alteracao->descricao}}</td>
        				<td>{{$obj->descricao}}</td>
        				<td>{{$obj->unidade_medida}}</td>
        				<td>{{$obj->numero_registro_cas}}</td>
        				<td>{{$obj->limite_conama}}</td>
        				<td>{{$obj->limite_oms}}</td>
        				<td class="d-flex justify-content-center">

                            <form action="{{ route('parametro.edit', $obj->id) }}" method="GET" style="margin-right:10px;">
               					<button type="submit" class="btn btn-sm btn-primary">
               						<i class="glyphicon glyphicon-pencil"></i> Editar
               				    </button>
                            </form>

                            <form action="{{ route('parametro.destroy', $obj->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente Excluir?')">
                                    <i class="glyphicon glyphicon-trash"></i>Excluir
                                </button>
                            </form>

        				</td>
        			</tr>
                @endforeach

            </tbody>
    	</table>
    </div>
    {{-- {{ $models->links() }} --}}
    <br>
    <a class="btn btn-primary" href="{{ route('parametro.create') }}">{{ __('Novo Parâmetro') }}</a>

@endsection

<style type="text/css">
    .container-fluid {
        background-color: white;
    }
</style>
