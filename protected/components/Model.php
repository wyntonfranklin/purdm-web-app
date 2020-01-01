<?php


class Model extends CActiveRecord
{

    public function getHTMLErrorSummary(){
        return CHtml::errorSummary($this);
    }

}
