<?php

namespace App\Models;

use App\Models\CompositeKeysBaseModel as CompositeKeysBaseModel;

class CategoriaParametro extends CompositeKeysBaseModel
{
    protected $table = 'categoria_parametro';
    protected $fillable =['fk_categoria', 'fk_parametro', 'concentracao_superior'];
    protected $primaryKey = ['fk_categoria', 'fk_parametro'];

    public function Parametro()
    {
        return $this->belongsTo('App\Models\Parametro', 'fk_parametro', 'id');
    }

    public function Categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'fk_categoria', 'id');
    }

}
