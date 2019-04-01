<?php

namespace App\Models;

use App\Models\CompositeKeysBaseModel as CompositeKeysBaseModel;

class AtividadeParametroMin extends CompositeKeysBaseModel
{
    protected $table = 'atividade_parametro_min';
    protected $primaryKey = ['fk_atividade', 'fk_parametro'];

    public function Parametro()
    {
        return $this->belongsTo('App\Models\Parametro', 'fk_parametro', 'id');
    }

    public function AtividadePreponderante()
    {
        return $this->belongsTo('App\Models\AtividadePreponderante', 'fk_atividade', 'id');
    }

}
