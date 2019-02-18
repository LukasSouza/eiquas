<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fiilable = [
        'descricao',
        'nota',
        'qualidade',
        'semaforo'
    ];

    public function CategoriaParametro()
    {
        return $this->belongsTo('App\Models\CategoriaParametro', 'fk_categoria', 'id_categoria');
    }
}
