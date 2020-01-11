<?php


class QueriesController extends Controller
{

    protected function getCategoryExpense(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getCategoryExpenseByFilter($filter, $_GET['category']));
    }

    protected function getAvgExpense()
    {
        $filter = $this->getReportFilterByYear($_GET);
        return Utils::formatMoney(Queries::getAvgExpense($filter));
    }

    protected function getAvgCategoryExpense()
    {
        $filter = $this->getReportFilterByYear($_GET);
        return Utils::formatMoney(
            Queries::getCategoryAvgExpense($filter,$_GET['category'])
        );
    }

    protected function getReportIncome(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getIncomeByFilter($filter));
    }

    protected function getAccountBalance(){
        $filter = $this->getReportFilterByAccount($_GET);
        return Utils::formatMoney(Queries::getAccountBalance($filter));
    }

    public function getIncomeThisMonth(){
        $month = date('m');
        return Utils::formatMoney(Queries::getIncomeByGivenMonth($month));
    }

    public function getExpenses(){
        $month = date('m');
        return Utils::formatMoney(Queries::getExpenses($month));
    }

    protected function getReportExpense(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getExpenseByFilter($filter));
    }

    protected function getSavings(){
        $month = date('m');
        return Utils::formatMoney(Queries::getSavings($month));
    }

    protected function getReportSavings(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getSavingsByFilter($filter));
    }

    protected function getNetWorth(){
        return Utils::formatMoney(Queries::getNetWorth());
    }

    protected function getReportFilter($settings){
        $filter= "";
        if(isset($settings['type'])){
            $type = $settings['type'];
            if($type == "month"){
                $nmonth = $settings['month'];
                $year = $settings['year'];
                $filter .= 'Month(trans_date)='. $nmonth.' AND Year(trans_date)='.$year;
            }else if($type=="range"){
                $filter .= 'trans_date between "'. $settings['startdate']
                    .'" AND "' . $settings['enddate']. '"';
            }
        }
        if(isset($settings['accountId']) && !empty($settings['accountId'])){
            $filter .= ' AND account_id=' . $settings['accountId'];
        }else{
            $filter .= ' AND ' . Utils::queryUserAccounts();
        }
        return $filter;
    }

    protected function getReportFilterByYear($settings){
        $filter= "";
        if(isset($settings['type'])){
            $type = $settings['type'];
            if($type == "month"){
                $year = $settings['year'];
                $filter .= 'Year(trans_date)='.$year;
            }else if($type=="range"){
                $currentYear = date("Y", strtotime($settings['startdate']));
                $filter .= 'Year(trans_date)='.$currentYear;
            }
        }
        if(isset($settings['accountId']) && !empty($settings['accountId'])){
            $filter .= ' AND account_id=' . $settings['accountId'];
        }else{
            $filter .= ' AND ' . Utils::queryUserAccounts();
        }
        return $filter;
    }

    protected function getReportFilterByAccount($settings){
        $filter= "";
        if(isset($settings['type'])){
            $type = $settings['type'];
            if($type == "month"){
                $year = $settings['year'];
                $filter .= 'Year(trans_date) <='.$year;
            }else if($type=="range"){
                $currentYear = date("Y", strtotime($settings['enddate']));
                $filter .= 'Year(trans_date) <='.$currentYear;
            }
        }
        if(isset($settings['accountId']) && !empty($settings['accountId'])){
            $filter .= ' AND account_id=' . $settings['accountId'];
        }else{
            $filter .= ' AND ' . Utils::queryUserAccounts();
        }
        Utils::logger($filter);
        return $filter;
    }

    protected function convert_to_months_dataset($key, $value, $source){
        $income_data = [];
        $match = false;
        if($source && is_array($source)){
            for($i=0; $i<= 11; $i++){
                $match = false;
                foreach($source as $query){
                    if($query[$key] == ($i+1)){
                        $income_data[] = $query[$value];
                        $match = true;
                        break;
                    }
                }
                if(!$match){
                    $income_data[] = 0;
                }
            }
            return $income_data;
        }
        return [];
    }

    protected function convert_data_to_pie_dataset($name, $source){
        $dataset = [];
        foreach ($source as $row){
            $dataset[] = $row[$name];
        }
        return $dataset;
    }

}
