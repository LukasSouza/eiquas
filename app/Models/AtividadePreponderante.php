<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadePreponderante extends Model
{
    protected $table = 'atividade_preponderante';

    protected $fiilable = [
        'descricao'
    ];

    public function AtividadeParametroMinimo()
    {
        return $this->hasMany('App\Models\AtividadeParametroMin', 'fk_atividade', 'id');
    }
}
