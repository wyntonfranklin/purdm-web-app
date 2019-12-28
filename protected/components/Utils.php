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

    public static function getReconcileIcon($type){
        if($type == 'minus'){
            return '<i style="color:darkred;" class="fa fa-minus"></i>';
        }else{
            return '<i style="color:green;" class="fa fa-plus"></i>';
        }
    }

    public static function getUserAccounts(){

    }

    public static function queryUserAccounts($col='account_id'){
        $query = "$col IN(";
        $accounts = Accounts::model()->findAll();
        foreach ($accounts as $account){
            $query .= $account->id . ",";
        }
        $query = rtrim($query,",");
        return $query . ")";
    }

    public static function pageSettings($settings=array()){
        $formattedSettings = json_encode($settings);
        $o = "<input type='hidden' id='page-settings' data-settings='$formattedSettings' />";
        return $o;
    }
}
