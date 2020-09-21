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

    public function getErrorSummaryAsText(){
        $m = $this;
        $content = "";
        foreach($m->getErrors() as $errors)
        {
            foreach($errors as $error)
            {
                if($error!='')
                    $content.= ''.CHtml::encode($error)."\r\n";
            }
        }
        return trim($content);
    }

}
