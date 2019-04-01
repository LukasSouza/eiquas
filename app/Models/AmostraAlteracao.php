<?php

namespace App\Models;



class AmostraAlteracao extends CompositeKeysBaseModel
{
    protected $table = 'amostraalteracao';
    protected $primaryKey = ['fk_amostra', 'fk_alteracao'];

    public function Amostra()
    {
        return $this->belongsTo('App\Models\Amostra', 'fk_amostra', 'id');
    }
    public function Alteracao()
    {
        return $this->belongsTo('App\Models\Alteracao', 'fk_alteracao', 'id');
    }

}
