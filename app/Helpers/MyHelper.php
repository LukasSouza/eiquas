<?php

function contains($string, $needle){
    if (strpos($string, $needle) !== false)
        return 1;
    return 0;
}

function VerifyDuplicateEntry($model){
    try{
        $model->save();
    }
    catch(\Exception $ex){
        $errors = array();
        $code = $ex->getCode();
        $message = $ex->getMessage();

        if( ($code == 23000)
            && contains($message,"Duplicate")
            && contains($message,"Integrity constraint violation")) {
                $errors = array("error" => "Erro. O Objeto cadastrado já existe!");
        } else {
            // Mostrar erro genérico
            $errors = array("error" => " Erro: Operação no banco de Dados!") ;
        }

        return $errors;
    }
    
    return false;
}
