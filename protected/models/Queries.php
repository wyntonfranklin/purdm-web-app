<?php


class Queries
{


    public static function getNetWorth(){
        $sql = "SELECT (income - expense) as networth FROM (
            SELECT (SElect sum(amount) From transactions WHERE type = \"income\"
            AND ".Utils::queryUserAccounts().") as income,
            (SELECT sum(amount) FROM transactions WHERE type =\"expense\"
             AND ".Utils::queryUserAccounts().") as expense 
            FROM transactions group by income) t;";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getIncome(){
        $sql = "SELECT sum(amount) FROM transactions WHERE type=\"income\";";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getIncomeByFilter($filter){
        if($filter){
            $sql = "SELECT sum(amount) FROM transactions WHERE type=\"income\" AND " . $filter;
        }else{
            $sql = "SELECT sum(amount) FROM transactions WHERE type=\"income\"";
        }
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getExpenseByFilter($filter){
        if($filter){
            $sql = "SELECT sum(amount) FROM transactions WHERE type=\"expense\" AND " . $filter ;
        }else{
            $sql = "SELECT sum(amount) FROM transactions WHERE type=\"expense\"";
        }
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getCategoryExpenseByFilter($filter, $cat){
        $sql = "SELECT sum(amount) FROM transactions 
        WHERE type=\"expense\" AND category='".$cat."' AND " . $filter ;
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getIncomeByGivenMonth($month){
        $sql = "SELECT sum(amount) FROM transactions WHERE type=\"income\" 
        AND ".Utils::queryUserAccounts()." AND Month(trans_date)=".$month;
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getExpenses($month){
        $sql = "SELECT sum(amount) FROM transactions WHERE type=\"expense\" 
        AND ".Utils::queryUserAccounts()." AND Month(trans_date)=".$month;
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getSavings($month){
        $sql = "SELECT (income - expense) as networth FROM (
            SELECT (SElect sum(amount) From transactions WHERE type = \"income\" 
            AND ".Utils::queryUserAccounts()." AND MONTH(trans_date) = ".$month.") as income,
            (SELECT sum(amount) FROM transactions WHERE type =\"expense\" 
            AND ".Utils::queryUserAccounts()." AND MONTH(trans_date) = ".$month.") as expense 
            FROM transactions group by income) t;";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getIncomeByMonth(){
        $year = Utils::getYear();
        $sql = "SELECT sum(amount) as total,Month(trans_date) as date 
        FROM transactions WHERE type=\"income\" 
        AND ".Utils::queryUserAccounts()." AND Year(trans_date)=".$year." group by MONTH(trans_date);";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getIncomeByMonthWithFilter($filter){
        $sql = "SELECT sum(amount) as total,Month(trans_date) as date 
        FROM transactions WHERE type=\"income\" AND ".$filter." group by MONTH(trans_date);";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getCategoryIncomeByMonthWithFilter($filter, $cat){
        $sql = "SELECT sum(amount) as total,Month(trans_date) as date 
        FROM transactions WHERE type=\"income\" AND category='".$cat."' AND ".$filter." group by MONTH(trans_date);";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getExpensesByMonthWithFilter($filter){
        $sql = "SELECT sum(amount) as total,Month(trans_date) as date 
        FROM transactions WHERE type=\"expense\" AND ".$filter." group by MONTH(trans_date);";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getCategoryExpensesByMonthWithFilter($filter,$cat){
        $sql = "SELECT sum(amount) as total,Month(trans_date) as date 
        FROM transactions WHERE type=\"expense\" AND category='".$cat."' AND ".$filter." group by MONTH(trans_date);";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getExpensesByMonth(){
        $sql = "SELECT sum(amount) as total,Month(trans_date) as date 
        FROM transactions WHERE type=\"expense\" AND ".Utils::queryUserAccounts()." 
        group by MONTH(trans_date);";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getTopExpensesByYear(){
        $sql = "SELECT sum(amount) as total, category from transactions Where type=\"expense\" 
        AND ".Utils::queryUserAccounts()." group by category order by total desc LIMIT 5;";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return null;
        }
        return $results;
    }

    public static function getAvgExpense($filter){
        $sql ="SELECT avg(amount) FROM wfexpenses.transactions where type=\"expense\" AND ". $filter;
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getCategoryAvgExpense($filter,$cat){
        $sql ="SELECT avg(amount) FROM wfexpenses.transactions 
        where type=\"expense\" AND category='".$cat."' AND ". $filter;
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }


    public static function getAllExpensesByYear($filter){
        $sql = "SELECT total, category, (total/(SELECT SUM(amount) FROM transactions)) *100 as percentage FROM 
        ( SELECT sum(amount) as total, category, @total_tax as dividen from transactions Where type=\"expense\" 
        AND ".$filter." group by category order by total desc
        ) t";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
        return $results;
    }

    public static function getSavingsByFilter($filter)
    {
        $sql = "SELECT (income - expense) as networth FROM (
            SELECT (SElect sum(amount) From transactions WHERE type = \"income\" 
            AND ".$filter.") as income,
            (SELECT sum(amount) FROM transactions WHERE type =\"expense\" 
            AND ".$filter.") as expense 
            FROM transactions group by income) t;";
        try{
            if($filter){
                $results = Yii::app()->db->createCommand($sql)->queryScalar();
            }else{
                return 0;
            }
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

    public static function getAccountBalance()
    {
        $sql = "SELECT (income - expense) as networth FROM (
            SELECT (SElect sum(amount) From transactions WHERE type = \"income\") as income,
            (SELECT sum(amount) FROM transactions WHERE type =\"expense\") as expense 
            FROM transactions group by income) t;";
        try{
            $results = Yii::app()->db->createCommand($sql)->queryScalar();
        }catch (Exception $e){
            return 0;
        }
        return $results;
    }

}
