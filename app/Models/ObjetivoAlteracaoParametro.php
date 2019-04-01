<?php

namespace App\Models;

use App\Models\CompositeKeysBaseModel as CompositeKeysBaseModel;

class ObjetivoAlteracaoParametro extends CompositeKeysBaseModel
{
    protected $table = 'objetivo_alteracao_parametro';
    protected $primaryKey = ['fk_objetivo', 'fk_alteracao', 'fk_parametro'];

    public function Parametro()
    {
        return $this->belongsTo('App\Models\Parametro', 'fk_parametro', 'id');
    }

    public function Alteracao()
    {
        return $this->belongsTo('App\Models\Alteracao', 'fk_alteracao', 'id');
    }

    public function Objetivo()
    {
        return $this->belongsTo('App\Models\Objetivo', 'fk_objetivo', 'id');
    }

}
