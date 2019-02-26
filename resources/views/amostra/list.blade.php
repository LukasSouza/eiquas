@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2>Amostras</h2>
    <p class="separator"></p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTable" aria-describedby="users_table" role="grid">
            <thead>
    			<tr>
                    <th>Descricao</th>
                    <th>Opções</th>
                </tr>
    		</thead>
    		<tbody>
                @foreach ($objetos as $obj)

                    <tr role="row" class="odd">
        				<td>{{$obj->descricao}}</td>
        				<td class="d-flex justify-content-center">

                            <form action="{{ route('alteracao.edit', $obj->id) }}" method="GET" style="margin-right:10px;">
               					<button type="submit" class="btn btn-sm btn-primary">
               						<i class="glyphicon glyphicon-pencil"></i> Editar
               				    </button>
                            </form>

                            <form action="{{ route('alteracao.destroy', $obj->id) }}" method="POST">
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
    <a class="btn btn-primary" href="{{ route('alteracao.create') }}">{{ __('Nova Alteração') }}</a>

@endsection

<style type="text/css">
    .container-fluid {
        background-color: white;
    }
</style>
