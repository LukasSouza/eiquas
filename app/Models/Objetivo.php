<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivo';

    protected $fiilable = [
        'descricao'
    ];

    public function ObjetivoAlteracaoParametro()
    {
        return $this->belongsTo('App\Models\ObjetivoAlteracaoParametro', 'fk_objetivo', 'id');
    }
}
