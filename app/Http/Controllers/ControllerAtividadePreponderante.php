<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtividadePreponderante as Model;
use App\Models\AtividadeParametroMin as AtividadeParametroMin;

class ControllerAtividadePreponderante extends Controller
{
    var $rota_list = 'atividade_preponderante';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetos = Model::all()->sortBy('descricao');
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

        $duplicateEntry = VerifyDuplicateEntry($Model);
        if(!$duplicateEntry){
            $Model->AtividadeParametroMinimo()->delete();

            foreach($request->parametros as $parametro){
                $atividadeParametroMin = new AtividadeParametroMin;
                $atividadeParametroMin->fk_parametro = $parametro;
                $atividadeParametroMin->fk_atividade = $Model->id;
                $atividadeParametroMin->save();
            }
            return redirect()->route($this->rota_list.'.index')->with('status', 'Cadastrado Realizado com Sucesso!');
        }
        else{
            return redirect()->route($this->rota_list.'.index')->with(key($duplicateEntry), current($duplicateEntry) );
        }
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
        $request->flashOnly('parametros');
        $Model = Model::find($id);
        $Model->descricao = $request->descricao;

        $duplicateEntry = VerifyDuplicateEntry($Model);
        if(!$duplicateEntry){
            $Model->AtividadeParametroMinimo()->delete();

            foreach($request->parametros as $parametro){
                $atividadeParametroMin = new AtividadeParametroMin;
                $atividadeParametroMin->fk_parametro = $parametro;
                $atividadeParametroMin->fk_atividade = $Model->id;
                $atividadeParametroMin->save();
            }
            return redirect()->route($this->rota_list.'.index')->with('status', 'Dados Atualizados com Sucesso!');
        }
        else{
            return redirect()->route($this->rota_list.'.index')->with(key($duplicateEntry), current($duplicateEntry) );
        }
        
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

        try{
            $objeto->AtividadeParametroMinimo()->delete();
            $objeto->delete();
        }
        catch(\Exception $e){
            return redirect()->route($this->rota_list.'.index')->with('error', 'Falha ao Excluir. Verifique se o item está sendo usado por algum cadastro no sistema.');
        }

        return redirect()->route($this->rota_list.'.index')->with('status', 'Cadastro Excluido com Sucesso');
    }
}
