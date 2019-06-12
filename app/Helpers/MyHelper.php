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

function converterData( $data ){
    if ($data == '' )
        return null;
    $date = date_create_from_format('Y-m-d', substr($data , 0 , 10));
    return date_format($date, 'd/m/Y');
}


function showHelper($message){
    return '
        <div class="col-md-1 helper">
            <a>
                <i class="material-icons help_outline" data-toggle="tooltip" data-placement="right" title=""
                data-original-title="'.$message.'">help_outline</i>
            </a>
        </div>
    ';
}
