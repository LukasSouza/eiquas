<?php

namespace App\Models;

use App\Models\CompositeKeysBaseModel as CompositeKeysBaseModel;

class AmostraAlteracaoParametro extends CompositeKeysBaseModel
{
    protected $table = 'amostra_alteracao_parametro';
    protected $primaryKey = ['fk_amostra', 'fk_alteracao', 'fk_parametro'];
}
