<?php

namespace App\Http\Controllers;

use App\Amostra;
use Illuminate\Http\Request;
use App\Models\Amostra as Model;
use App\Models\AtividadeParametroMin as AtividadeParametroMin;
use App\Models\Objetivo as Objetivo;
use App\Models\AtividadePreponderante as AtividadePreponderante;
use App\Models\AmostraAlteracao as AmostraAlteracao;
use App\Models\AmostraAlteracaoParametro as AmostraAlteracaoParametro;
use App\Models\ObjetivoAlteracaoParametro as ObjetivoAlteracaoParametro;
use App\Models\CategoriaParametro as CategoriaParametro;
use App\Models\Parametro as Parametro;
use function Opis\Closure\unserialize;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerAmostra extends Controller
{
    var $rota_list = 'amostra';

    private function menor_nota($x, $y){
        if($x < $y)
            return $x;
        else
            return $y;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){
            $objetos = Model::all()->sortBy('descricao');
            // $objetos = Model::where('fk_user',Auth::user()->id)->get();
        }
        else {
            return view($this->rota_list.'.create');
        }
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
        //inicializando a categoria
        $categoria =4;
        $request = unserialize($request->array);
        //dd($request);
        //Salvar Amostra
        $amostra = new Model;
        $amostra->descricao = $request->descricao;
        $amostra->fk_user = Auth::user()->id;
        $amostra->id_atividade_preponderante = $request->atividade_preponderante;
        $amostra->ponto_coleta = $request->ponto_coleta;
        $amostra->data_coleta = $request->data_coleta;
        $amostra->condicao_tempo = $request->condicao_tempo;
        $amostra->numero_amostra = $request->numero_amostra;
        $amostra->analise_confiavel = $request->analise_confiavel;


        $duplicateEntry = VerifyDuplicateEntry($amostra);
        if(!$duplicateEntry){
            //procurar as alterações ligadas aos parametros/Objetivo
            $objetivoAlteracaoParametros = ObjetivoAlteracaoParametro::where('fk_objetivo',$request->objetivo)->whereIn('fk_parametro',$request->parametros)->get();

            $array_fk_alteracoes = Array();
            //Salvar na tabela AmostraAlteracaoParametro e AmostraAlteracaoParametro
            foreach($objetivoAlteracaoParametros as $key => $objAltParam){
                $amostraAlteracao = new AmostraAlteracao;
                $amostraAlteracao->fk_amostra = $amostra->id;
                $amostraAlteracao->fk_alteracao = $objAltParam->fk_alteracao;
                $amostraAlteracao->nota_alteracao = 100;

                //Não Salvar AmostraAlteracao com msms ID's
                if(!in_array($objAltParam->fk_alteracao, $array_fk_alteracoes)){
                    $amostraAlteracao->save();
                    //Array de verificação de id's salvos
                    $array_fk_alteracoes[] = $objAltParam->fk_alteracao;
                }

                //Definindo a nota de cada parâmetro..
                $categoriaParametros = CategoriaParametro::where('fk_parametro',$objAltParam->fk_parametro)->orderBy('concentracao_superior', 'asc')->get();
                foreach($categoriaParametros as $categoriaParametro){

                    if($categoriaParametro->concentracao_superior >= $request->concentracao[$key]){
                        echo $categoriaParametro->concentracao_superior ." > ". $request->concentracao[$key]."<br>";
                        $categoria = $categoriaParametro->fk_categoria;
                        break;
                    }
                }
                //Salvando cada parametro e alteracao da amostra
                $AmostraAlteracaoParametro = new AmostraAlteracaoParametro;
                $AmostraAlteracaoParametro->fk_amostra = $amostra->id;
                $AmostraAlteracaoParametro->fk_alteracao = $objAltParam->fk_alteracao;
                $AmostraAlteracaoParametro->fk_parametro = $objAltParam->fk_parametro;
                $AmostraAlteracaoParametro->concentracao = $request->concentracao[$key];
                $AmostraAlteracaoParametro->nota_parametro = $categoria;
                $AmostraAlteracaoParametro->save();
            }

            //calcular a Categoria (Nota), de cada alteracao
            $ArrayMenorConcentracaoAlteracao = Array();
            $ArrayAmostraAlteracaoParametro = AmostraAlteracaoParametro::leftJoin('categoria', 'nota_parametro', '=', 'categoria.id')->where('fk_amostra',$amostra->id)->get();
            foreach($array_fk_alteracoes as $key => $id_alteracao){
                $ArrayMenorConcentracaoAlteracao[$key] = 999;
                foreach($ArrayAmostraAlteracaoParametro as $amostraAlteracaoParametro){
                    if($id_alteracao == $amostraAlteracaoParametro->fk_alteracao){
                        $ArrayMenorConcentracaoAlteracao[$key] = $this->menor_nota($ArrayMenorConcentracaoAlteracao[$key], $amostraAlteracaoParametro->nota);
                    }
                }
            }

            //Salvar Notas das alterações
            foreach($ArrayMenorConcentracaoAlteracao as $key => $nota){
                $categoria = Categoria::where('nota', $nota)->first();

                $amostraAlteracao = AmostraAlteracao::where('fk_amostra', $amostra->id)->where('fk_alteracao',$array_fk_alteracoes[$key])->first();
                $amostraAlteracao->nota_alteracao = $categoria->id;
                $amostraAlteracao->save();
            }

            //calcular a Categoria (Nota) da Amostra
            $notaAmostra = min($ArrayMenorConcentracaoAlteracao);
            $categoria = Categoria::where('nota', $notaAmostra)->first();

            $amostraUpdate = Model::find($amostra->id);
            $amostraUpdate->eiquas = $categoria->id;
            $amostraUpdate->save();
            //Ir para tela de Exibição de Resultado
            $id = $amostraUpdate->id;
            return redirect()->route($this->rota_list.'.show', $id)->with('status', 'Cadastrado Realizado com Sucesso!');
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
        $amostra = Model::find($id);
        $objetivo = Objetivo::find(1);
        $atividadePreponderante = AtividadePreponderante::where('id', $amostra->id_atividade_preponderante)->first();
        $categoria = Categoria::where('id',$amostra->eiquas)->first();

        $arrayAmostraAlteracao = AmostraAlteracao::where('fk_amostra', $amostra->id)->first();
        $ArrayAmostraAlteracaoParametro = AmostraAlteracaoParametro::where('fk_amostra', $amostra->id)->first();
        $alteracoes = DB::table('alteracao')
        ->leftJoin('amostraalteracao', 'alteracao.id', '=', 'amostraalteracao.fk_alteracao' )
        ->leftJoin('categoria', 'categoria.id', '=', 'nota_alteracao' )
        ->select('alteracao.*', 'nota')
        ->where('fk_amostra', '=', $id)
        ->orWhereNull('fk_amostra')
        ->orderBy('alteracao.id')
        ->get();
        return view('amostra.view',
            ['amostra' => $amostra,
             'objetivo' => $objetivo,
             'categoria' => $categoria,
             'arrayAmostraAlteracao' => $arrayAmostraAlteracao,
             'ArrayAmostraAlteracaoParametro' => $ArrayAmostraAlteracaoParametro,
             'atividadePreponderante' => $atividadePreponderante,
             'alteracoes' => $alteracoes
            ]
        );
    }
    public function show_complete($id)
    {
        $amostra = Model::find($id);
        $objetivo = Objetivo::find(1);
        $atividadePreponderante = AtividadePreponderante::where('id', $amostra->id_atividade_preponderante)->first();
        $categoria = Categoria::where('id',$amostra->eiquas)->first();

        $arrayAmostraAlteracao = AmostraAlteracao::where('fk_amostra', $amostra->id)->first();
        $ArrayAmostraAlteracaoParametro = AmostraAlteracaoParametro::where('fk_amostra', $amostra->id)->first();
        $alteracoes = DB::table('alteracao')
        ->leftJoin('amostraalteracao', 'alteracao.id', '=', 'amostraalteracao.fk_alteracao' )
        ->leftJoin('categoria', 'categoria.id', '=', 'nota_alteracao' )
        ->select('alteracao.*', 'nota')
        ->where('fk_amostra', '=', $id)
        ->orderBy('alteracao.id')
        ->get();

        return view('amostra.view_complete',
            ['amostra' => $amostra,
             'objetivo' => $objetivo,
             'categoria' => $categoria,
             'arrayAmostraAlteracao' => $arrayAmostraAlteracao,
             'ArrayAmostraAlteracaoParametro' => $ArrayAmostraAlteracaoParametro,
             'atividadePreponderante' => $atividadePreponderante,
             'alteracoes' => $alteracoes
            ]
        );
    }

    /**
     * Confirm the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  $id
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
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
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
            $objeto->AmostraAlteracaoParametro()->delete();
            $objeto->AmostraAlteracao()->delete();
            $objeto->delete();
        }
        catch(\Exception $e){
            return redirect()->route($this->rota_list.'.index')->with('error', 'Falha ao Excluir. Verifique se o item está sendo usado por algum cadastro no sistema.');
        }

        return redirect()->route($this->rota_list.'.index')->with('status', 'Cadastro Excluido com Sucesso');
    }


}
