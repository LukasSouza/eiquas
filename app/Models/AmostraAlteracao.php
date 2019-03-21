<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AmostraAlteracao extends Model
{
    protected $table = 'amostra_alteracao';
    protected $primaryKey = ['fk_amostra', 'fk_alteracao'];
    public $incrementing = false;

    public function Amostra()
    {
        return $this->belongsTo('App\Models\Amostra', 'fk_amostra', 'id');
    }
    public function Alteracao()
    {
        return $this->belongsTo('App\Models\Alteracao', 'fk_alteracao', 'id');
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
