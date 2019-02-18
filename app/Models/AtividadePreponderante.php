<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadePreponderante extends Model
{
    protected $table = 'atividade_preponderante';

    protected $fiilable = [
        'descricao'
    ];

    public function AtividadeParametroMin()
    {
        return $this->belongsTo('App\Models\AtividadeParametroMin', 'fk_atividade', 'id_atividade');
    }
}
