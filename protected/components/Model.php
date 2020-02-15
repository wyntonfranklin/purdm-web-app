<?php


class Model extends CActiveRecord
{

    public function getHTMLErrorSummary(){
        $errors = CHtml::errorSummary($this);
        if($errors){
            return $errors;
        }else{
            return "";
        }
    }

}
