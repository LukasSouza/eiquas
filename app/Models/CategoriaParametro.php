<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaParametro extends Model
{
    protected $table = 'categoria_parametro';
    protected $fillable =['fk_categoria', 'fk_parametro', 'concentracao_superior'];
    protected $primaryKey = ['fk_categoria', 'fk_parametro'];
    public $incrementing = false;

    public function Parametro()
    {
        return $this->belongsTo('App\Models\Parametro', 'fk_parametro', 'id');
    }

    public function Categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'fk_categoria', 'id');
    }


    protected function setKeysForSaveQuery(Builder $query)
{
    $keys = $this->getKeyName();
    if(!is_array($keys)){
        return parent::setKeysForSaveQuery($query);
    }

    foreach($keys as $keyName){
        $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
    }

    return $query;
}

/**
 * Get the primary key value for a save query.
 *
 * @param mixed $keyName
 * @return mixed
 */
protected function getKeyForSaveQuery($keyName = null)
{
    if(is_null($keyName)){
        $keyName = $this->getKeyName();
    }

    if (isset($this->original[$keyName])) {
        return $this->original[$keyName];
    }

    return $this->getAttribute($keyName);
}
}
