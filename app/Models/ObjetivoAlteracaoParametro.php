<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjetivoAlteracaoParametro extends Model
{
    protected $table = 'objetivo_alteracao_parametro';
    protected $primaryKey = ['fk_objetivo', 'fk_alteracao', 'fk_parametro'];
    public $incrementing = false;

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
