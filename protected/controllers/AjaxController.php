<?php


class AjaxController extends Controller
{

    public function outputJson($data){
        header('Content-Type: application/json');
        echo json_encode(["data"=>$data]);
    }

    public function actionGetTotals(){
        $data = [
          'income' => $this->getIncome(),
          'expenses' => $this->getExpenses(),
            'worth' => $this->getNetWorth(),
            'savings' => $this->getSavings()
        ];
        $this->outputJson($data);
    }

    public function actionGetAccountTotals(){
        $data = [
            'income' => $this->getIncome(),
            'expenses' => $this->getExpenses(),
            'average' => '$100,000.00',
            'savings' => $this->getSavings()
        ];
        $this->outputJson($data);
    }

    private function getIncome(){
        return "$" . Queries::getIncome();
    }

    private function getExpenses(){
        return "$" . Queries::getExpenses();
    }

    private function getSavings(){
        return round(Queries::getSavings());
    }

    private function getNetWorth(){
        return round(Queries::getNetWorth());
    }

    public function actionChart($name){
        if($name == "income_expenditure"){

        }
    }

    public function actionGetTransactionsTable(){
        echo $this->renderPartial('dashboard_transactions');
    }

    public function actionGetExpenseListing(){
        echo $this->renderPartial('list_expenses');
    }

    public function actionGetIncomeExpenditureChartData(){
        echo json_encode(
            ['data' => $this->getIncomeExpenditure()]
        );
    }

    private function getIncomeExpenditure(){
        $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $queryData = Queries::getIncomeByMonth();
        $income_data = [];
        $income_dataset = [];
        $match = false;
        for($i=0; $i<= 11; $i++){
            $match = false;
            foreach($queryData as $query){
                if($query['date'] == ($i+1)){
                   $income_data[] = $query['total'];
                   $match = true;
                    break;
                }
            }
            if(!$match){
                $income_data[] = 0;
            }
        }
        return [
            'dataset' => $income_data,
            'labels' => $labels
        ];
    }

    public function actionTest(){
        var_dump($this->getIncomeExpenditure());
    }



}
