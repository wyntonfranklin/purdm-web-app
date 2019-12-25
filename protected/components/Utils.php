<?php


class Utils
{

    public static function formatMoney($value){
        return money_format('%.2n', $value);
    }

    public static function getMonth(){
        return date('M');
    }

    public static function getYear(){
        return date('Y');
    }

    public static function getTransactionIcon($type){
        if($type == 'expense'){
            return '<i style="color:darkred;" class="fa fa-minus"></i>';
        }else{
            return '<i style="color:green;" class="fa fa-plus"></i>';
        }
    }
}
