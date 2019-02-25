<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amostra extends Model
{
    protected $table = 'amostra';

    protected $fiilable = [
        'id_atividade_preponderante',
        'descricao',
        'ponto_coleta',
        'data_coleta',
        'cd_tempo',
        'numero_amostra',
        'eiquas'
    ];

    public function AmostraAlteracao()
    {
        return $this->belongsTo('App\Models\AmostraAlteracao', 'fk_amostra', 'id');
    }

}
