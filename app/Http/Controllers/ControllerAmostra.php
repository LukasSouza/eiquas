<?php

namespace App\Http\Controllers;

use App\Amostra;
use Illuminate\Http\Request;
use App\Models\Amostra as Model;
use App\Models\AtividadeParametroMin as AtividadeParametroMin;
use App\Models\Objetivo as Objetivo;
use App\Models\AtividadePreponderante as AtividadePreponderante;
use App\Models\Parametro as Parametro;
use function Opis\Closure\unserialize;
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
        $request = unserialize($request->array);
        dd($request);
        $Model = new Model;
        $Model->descricao = $request->descricao;
        $Model->id_atividade_preponderante = $request->atividade_preponderante;
        $Model->ponto_coleta = $request->ponto_coleta;
        $Model->data_coleta = $request->data_coleta;
        $Model->condicao_tempo = $request->condicao_tempo;
        $Model->numero_amostra = $request->numero_amostra;

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
        $parametros_obrigatorios_nao_escolhidos = [];
        $objeto = $request->all();

        $atividadeParametroMin = AtividadeParametroMin::where('fk_atividade',$request->atividade_preponderante)->get();

        //Pegando descrição dos ID's
        $objetivo = Objetivo::find($request->objetivo);
        $objeto['objetivo_desc'] = $objetivo->descricao;

        $atividadePreponderante = AtividadePreponderante::find($request->atividade_preponderante);
        $objeto['atividade_preponderante_desc'] = $atividadePreponderante->descricao;

        foreach($objeto['parametros'] as $key => $parametro_id){
            $parametro = Parametro::find($parametro_id);
            $objeto['parametros_desc'][$key] = $parametro->descricao." (".$parametro->unidade_medida.")";
        }
        //FIM

        foreach($atividadeParametroMin as $parametro_obrigatorio){
            if(!in_array($parametro_obrigatorio->fk_parametro, $request->parametros)){
                $parametros_obrigatorios_nao_escolhidos[] = $parametro_obrigatorio->fk_parametro;
            }
        }
        return view($this->rota_list.'.confirm', ['objeto' => $objeto, 'parametros_obrigatorios_nao_escolhidos' => $parametros_obrigatorios_nao_escolhidos] );
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
