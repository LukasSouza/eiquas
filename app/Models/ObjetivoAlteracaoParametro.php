<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
