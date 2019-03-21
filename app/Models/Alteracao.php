<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alteracao extends Model
{
    protected $table = 'alteracao';

    protected $fiilable = [
        'descricao'
    ];

    public function AmostraAlteracao()
    {
        return $this->belongsTo('App\Models\AmostraAlteracao', 'fk_alteracao', 'id');
    }
}
