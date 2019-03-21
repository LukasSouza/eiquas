<?php

namespace App\Http\Controllers;

use App\Amostra;
use Illuminate\Http\Request;
use App\Models\Amostra as Model;
class ControllerAmostra extends Controller
{
    var $rota_list = 'amostra';
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
        $Model->descricao = $request->descricao;
        $Model->id_atividade_preponderante = $request->id_atividade_preponderante;
        $Model->ponto_coleta = $request->ponto_coleta;
        $Model->data_coleta = $request->data_coleta;
        $Model->cd_tempo = $request->cd_tempo;
        $Model->numero_amostra = $request->numero_amostra;
        $Model->eiquas = $request->eiquas;

        $Model->save();
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
     * Confirm the specified resource.
     *
     * @param  \App\Models\Alteracao  $alteracao
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        dd($request->all());
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
        $Model->descricao = $request->descricao;
        $Model->id_atividade_preponderante = $request->id_atividade_preponderante;
        $Model->ponto_coleta = $request->ponto_coleta;
        $Model->data_coleta = $request->data_coleta;
        $Model->cd_tempo = $request->cd_tempo;
        $Model->numero_amostra = $request->numero_amostra;
        $Model->eiquas = $request->eiquas;

        $Model->save();
        return redirect()->route($this->rota_list.'.index')->with('status', 'Dados Atualizados com Sucesso!');
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
