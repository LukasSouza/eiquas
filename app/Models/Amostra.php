<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amostra extends Model
{
    protected $table = 'amostra';

    protected $fiilable = [
        'fk_user',
        'id_atividade_preponderante',
        'descricao',
        'ponto_coleta',
        'data_coleta',
        'cd_tempo',
        'numero_amostra',
        'eiquas',
        'analise_confiavel'
    ];

    public function AmostraAlteracao()
    {
        return $this->belongsTo('App\Models\AmostraAlteracao', 'id', 'fk_amostra');
    }
    public function AmostraAlteracaoParametro()
    {
        return $this->belongsTo('App\Models\AmostraAlteracaoParametro', 'id', 'fk_amostra');
    }

}
