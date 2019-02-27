<?php

namespace App\Http\Controllers;

use App\Parametro;
use Illuminate\Http\Request;
use App\Models\Parametro as Model;
use App\Models\ObjetivoAlteracaoParametro as ObjetivoAlteracaoParametro;
use App\Models\CategoriaParametro as CategoriaParametro;

class ControllerParametro extends Controller
{
    var $rota_list = 'parametro';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetos = Model::all();
        return view($this->rota_list.'.list',compact('objetos') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->rota_list.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Model = new Model;
        $Model->descricao = $request->nome;
        $Model->unidade_medida = $request->unidade;
        $Model->numero_registro_cas = $request->numero_registro_cas;
        $Model->limite_conama = $request->limite_conama;
        $Model->limite_oms = $request->limite_oms;

        $Model->save();

        $ObjetivoAlteracaoParametro = new ObjetivoAlteracaoParametro;
        $ObjetivoAlteracaoParametro->fk_alteracao = $request->alteracao;
        $ObjetivoAlteracaoParametro->fk_parametro = $Model->id;
        $ObjetivoAlteracaoParametro->fk_objetivo = 1;
        $ObjetivoAlteracaoParametro->save();

        foreach ($request->concentracao_superior as $key => $concentracao_superior) {
            $CategoriaParametro = new CategoriaParametro;
            $CategoriaParametro->fk_categoria = $key+1;
            $CategoriaParametro->fk_parametro = $Model->id;
            $CategoriaParametro->concentracao_superior = str_replace(',', '.', $concentracao_superior);
            $CategoriaParametro->save();
        }

        return redirect()->route($this->rota_list.'.index')->with('status', 'Cadastrado Realizado com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alteracao  $alteracao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alteracao  $alteracao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objeto=Model::find($id);
        //print_r($objeto->ObjetivoAlteracaoParametro()->first()->Alteracao()->first());
        return view($this->rota_list.'.create', compact('objeto') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alteracao  $alteracao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Model = Model::find($id);
        $Model->descricao = $request->nome;
        $Model->unidade_medida = $request->unidade;
        $Model->numero_registro_cas = $request->numero_registro_cas;
        $Model->limite_conama = $request->limite_conama;
        $Model->limite_oms = $request->limite_oms;

        $Model->save();

        $ObjetivoAlteracaoParametro = ObjetivoAlteracaoParametro::where('fk_parametro', $id)
                            ->where('fk_objetivo','1')
                            ->first();
        $ObjetivoAlteracaoParametro->fk_alteracao = $request->alteracao;
        $ObjetivoAlteracaoParametro->save();


        foreach ($request->concentracao_superior as $key => $concentracao_superior) {
            $chave = $key+1;
            $CategoriaParametro = CategoriaParametro::where('fk_parametro', $id)
                                ->where('fk_categoria', $chave)
                                ->first();

            $CategoriaParametro->concentracao_superior = str_replace(',', '.', $concentracao_superior);
            //dd($CategoriaParametro);
            $CategoriaParametro->save();
            //$Model->CategoriaParametro()->save($CategoriaParametro);
        }

    //    return redirect()->route($this->rota_list.'.index')->with('status', 'Dados Atualizados com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alteracao  $alteracao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objeto=Model::find($id);

        if (is_null($objeto)){
           echo "Código Invalido";
           return redirect()->route($this->rota_list.'.index')->with('status', 'Cadastro não encontrado no sistema');
        }

        Model::find($id)->delete();

        return redirect()->route($this->rota_list.'.index')->with('status', 'Cadastro Excluido com Sucesso');
    }
}
