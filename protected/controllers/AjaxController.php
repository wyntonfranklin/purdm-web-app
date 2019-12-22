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
          'expenses' => '$215,00',
            'worth' => '$100,000.00',
            'savings' => '$20,00.00'
        ];
        $this->outputJson($data);
    }

    public function actionGetAccountTotals(){
        $data = [
            'income' => $this->getIncome(),
            'expenses' => '$215,00',
            'average' => '$100,000.00',
            'savings' => '$20,00.00'
        ];
        $this->outputJson($data);
    }

    private function getIncome(){
        return "$115,00";
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



}
