<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametro';

    protected $fiilable = [
        'descricao',
        'unidade_medida',
        'numero_registro_cas',
        'limite_conama',
        'limite_oms'
    ];

    public function ObjetivoAlteracaoParametro()
    {
        return $this->belongsTo('App\Models\ObjetivoAlteracaoParametro', 'id', 'fk_parametro');
    }

    public function AmostraAlteracaoParametro()
    {
        return $this->belongsTo('App\Models\AmostraAlteracaoParametro', 'id', 'fk_parametro');
    }

    public function CategoriaParametro()
    {
        return $this->hasMany('App\Models\CategoriaParametro', 'fk_parametro', 'id');
    }

    public function AtividadeParametroMin()
    {
        return $this->belongsTo('App\Models\AtividadeParametroMin', 'id', 'fk_parametro');
    }
}
