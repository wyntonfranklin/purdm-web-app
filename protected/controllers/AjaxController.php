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
            'average' => $this->getAvgExpense(),
            'savings' => $this->getSavings()
        ];
        $this->outputJson($data);
    }

    private function getAvgExpense()
    {
        return round(Queries::getAvgExpense());
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
        $criteria = new CDbCriteria();
        $criteria->order = 'transaction_id DESC';
        $transactions = Transaction::model()->findAll($criteria);
        echo $this->renderPartial('dashboard_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetExpenseListing(){
        echo $this->renderPartial('list_expenses');
    }

    public function actionGetIncomeExpenditureChartData(){
        echo json_encode(
            ['data' => $this->getIncomeExpenditure()]
        );
    }

    public function actionGetTopExpenses(){
        echo json_encode([
           'data' => $this->getTopExpenses()
        ]);
    }

    public function actionGetAllExpenses(){
        echo json_encode([
            'data' => $this->getAllExpenses()
        ]);
    }

    public function actionGetCalendarTransactions(){
        $dates = $this->convertTransactionsToCalendar();
        echo json_encode(
            [
                'data'=>$dates
            ]
        );
    }

    public function actionSaveTransaction(){
        $model = new Transaction();
        $model->trans_date = $_POST['transDate'];
        $model->amount = $_POST['amount'];
        $model->category = $_POST['category'];
        $model->description = $_POST['description'];
        $model->account_id = 1;
        $model->type = $_POST['transType'];
        $model->save();
    }

    public function actionSaveUserCategory(){
        $model = new UserCategories();
        $model->name = $_POST['usercategory'];
        $model->userid = 1;
        $model->save();
    }

    private function convertTransactionsToCalendar(){
        $transactions = Transaction::model()->findAll();
        $calendar_dates = [];
        foreach ($transactions as $transaction){
            $calendar_dates[] = [
                'title' => $transaction->description,
                'description' => $transaction->amount . "(" . $transaction->category. ")",
                'start' => $transaction->trans_date,
                'className' => "fc-event-solid-info fc-event-light"
            ];
        }
        return $calendar_dates;
    }


    private function getIncomeExpenditure(){
        $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $incomeData = Queries::getIncomeByMonth();
        $income_data = $this->convert_to_months_dataset('date','total', $incomeData);
        $expenseData = Queries::getExpensesByMonth();
        $expense_data  = $this->convert_to_months_dataset('date','total', $expenseData);
        return [
            'income' => $income_data,
            'expense' => $expense_data,
            'labels' => $labels
        ];
    }

    public function actionTest(){
        $results = $this->create_hex_colors(30);
        file_put_contents('/home/shady/Documents/websites/wfexpenses/colors.php', var_export($results,true));
    }

    private function getTopExpenses(){
        $data = Queries::getTopExpensesByYear();
        $labels = $this->convert_data_to_pie_dataset('category', $data);
        $dataset = $this->convert_data_to_pie_dataset('total',$data);
        return [
            'labels' => $labels,
            'dataset' => $dataset
        ];
    }

    private function getAllExpenses(){
        $data = Queries::getAllExpensesByYear();
        $labels = $this->convert_data_to_pie_dataset('category', $data);
        $dataset = $this->convert_data_to_pie_dataset('total',$data);
        return [
            'labels' => $labels,
            'dataset' => $dataset,
            'colors' => $this->getHexColors(count($labels))
        ];
    }

    private function convert_to_months_dataset($key, $value, $source){
        $income_data = [];
        $match = false;
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

    private function convert_data_to_pie_dataset($name, $source){
        $dataset = [];
        foreach ($source as $row){
            $dataset[] = $row[$name];
        }
        return $dataset;
    }




}
