<?php


class AjaxController extends Controller
{

    public $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function outputJson($data){
        header('Content-Type: application/json');
        echo json_encode(["data"=>$data]);
    }

    public function actionGetTotals(){
        $data = [
          'income' => $this->getIncomeThisMonth(),
          'expenses' => $this->getExpenses(),
            'worth' => $this->getNetWorth(),
            'savings' => $this->getSavings()
        ];
        $this->outputJson($data);
    }

    public function actionGetAccountTotals(){
        $data = [
            'income' => $this->getReportIncome(),
            'expenses' => $this->getReportExpense(),
            'balance' => $this->getAccountBalance(),
            'savings' => $this->getReportSavings(),
        ];
        $this->outputJson($data);
    }

    public function actionGetInsightsTotals(){
        $data = [
            'income' => $this->getReportIncome(),
            'expenses' => $this->getReportExpense(),
            'average' => $this->getAvgExpense(),
            'savings' => $this->getReportSavings(),
        ];
        $this->outputJson($data);
    }

    public function actionGetCategoryTotals(){
        $data = [
            'expenses' => $this->getCategoryExpense(),
            'average' => $this->getAvgCategoryExpense(),
        ];
        $this->outputJson($data);
    }

    private function getCategoryExpense(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getCategoryExpenseByFilter($filter, $_GET['category']));
    }

    private function getAvgExpense()
    {
        $filter = $this->getReportFilterByYear($_GET);
        return Utils::formatMoney(Queries::getAvgExpense($filter));
    }

    private function getAvgCategoryExpense()
    {
        $filter = $this->getReportFilterByYear($_GET);
        return Utils::formatMoney(
            Queries::getCategoryAvgExpense($filter,$_GET['category'])
        );
    }

    private function getReportIncome(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getIncomeByFilter($filter));
    }

    private function getAccountBalance(){
        $filter = $this->getReportFilterByAccount($_GET);
        return Utils::formatMoney(Queries::getAccountBalance($filter));
    }

    private function getReportFilter($settings){
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

    private function getReportFilterByYear($settings){
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

    private function getReportFilterByAccount($settings){
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

    private function getIncomeThisMonth(){
        $month = date('m');
        return Utils::formatMoney(Queries::getIncomeByGivenMonth($month));
    }

    private function getExpenses(){
        $month = date('m');
        return Utils::formatMoney(Queries::getExpenses($month));
    }

    private function getReportExpense(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getExpenseByFilter($filter));
    }

    private function getSavings(){
        $month = date('m');
        return Utils::formatMoney(Queries::getSavings($month));
    }

    private function getReportSavings(){
        $filter = $this->getReportFilter($_GET);
        return Utils::formatMoney(Queries::getSavingsByFilter($filter));
    }

    private function getNetWorth(){
        return Utils::formatMoney(Queries::getNetWorth());
    }

    public function actionChart($name){
        if($name == "income_expenditure"){

        }
    }

    public function actionGetTransactionsTableByQuery(){
        $query = isset($_GET['query']) ? $_GET['query'] : null;
        $criteria = new CDbCriteria();
        $criteria->addCondition('type="income" or type="expense"');
        if($query){
            $criteria->compare('category',$query,true,'AND');
            $criteria->compare('description',$query, true,'OR');
            $criteria->compare('amount',$query, false,'OR');
            $criteria->compare('memo',$query, true,'OR');
        }
        $criteria->addCondition(Utils::queryUserAccounts());
        Utils::logger($criteria->condition);
        $criteria->limit = 300;
        $criteria->order = 'trans_date DESC';
        $transactions = Transaction::model()->findAll($criteria);
        echo $this->renderPartial('dashboard_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetTransactionsTable(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('type="income" or type="expense"');
        $criteria->addCondition(Utils::queryUserAccounts());
        $criteria->limit = 300;
        $criteria->order = 'trans_date DESC';
        $transactions = Transaction::model()->findAll($criteria);
        echo $this->renderPartial('dashboard_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetTransactionsTableByAccount(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('type="income" or type="expense"');
        $criteria->addCondition('account_id='.$_GET['accountId']);
        $criteria->limit = 300;
        $criteria->order = 'trans_date DESC';
        $transactions = Transaction::model()->findAll($criteria);
        echo $this->renderPartial('dashboard_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetTransactionsTableWithFilters(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('type="income" or type="expense"');
        $criteria->addCondition($this->getReportFilter($_GET));
        $criteria->order = 'trans_date DESC';
        $transactions = Transaction::model()->findAll($criteria);
        echo $this->renderPartial('dashboard_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetCategoryTransactionsTableWithFilters(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('category="'.$_GET['category'].'"');
        $criteria->addCondition($this->getReportFilter($_GET));
        $criteria->order = 'trans_date DESC';
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

    public function actionGetReportIEChartData(){
        echo json_encode(
            ['data' => $this->getReportIncomeExpenditure($_GET)]
        );
    }

    public function actionGetCategoryIEChartData(){
        echo json_encode(
            ['data' => $this->getCategoryIncomeExpenditure($_GET)]
        );
    }

    public function actionGetTopExpenses(){
        echo json_encode([
           'data' => $this->getTopExpenses()
        ]);
    }

    public function actionGetAllExpenses(){
        echo json_encode([
            'data' => $this->getAllExpenses($_GET)
        ]);
    }

    public function actionGetCalendarTransactions(){
        $accountId = isset($_GET['accountId']) ? $_GET['accountId'] : "";
        $dates = $this->convertTransactionsToCalendar($accountId);
        echo json_encode(
            [
                'data'=>$dates
            ]
        );
    }

    public function actionSaveTransaction(){
        $model = new Transaction();
        $model->setScenario('save-trans');
        $model->trans_date = $_POST['transDate'];
        $model->assignAmount($_POST['amount']);
        $model->amount = $_POST['amount'];
        $model->category = $_POST['category'];
        $model->description = $_POST['description'];
        $model->account_id = $_POST['account'];
        $model->type = $_POST['transType'];
        $model->memo = $_POST['memo'];
        $frequency = isset($_POST['frequency']) ? $_POST['frequency'] : null;
        if($model->save()){
            if(!empty($frequency)){
                $this->createRepeatTransaction($model, $frequency);
            }
            Utils::jsonResponse(Utils::STATUS_GOOD,'Transaction successfully saved');
        }else{
            Utils::logger( CHtml::errorSummary($model));
            Utils::jsonResponse(Utils::STATUS_BAD,
                $this->getErrorSummaryAsText($model->getHTMLErrorSummary()));
        }
    }


    public function createRepeatTransaction($transaction, $freq){
        $model = RepeatTransaction::model()->findByAttributes(['transaction_id'=>$transaction->id]);
        if(!empty($freq)){
            if($model == null ){
                $model = new RepeatTransaction();
                $model->created_date = $transaction->trans_date;
                $model->transaction_id = $transaction->id;
            }
            if($model->isNewRecord){
                $model->frequency = $freq;
                $model->setUpComingDateFromFrequency();
                $model->save();
            }else{
                if($model->frequency != $freq){
                    $model->frequency = $freq;
                    //$model->setCurrentUpComingDate();
                }
                $model->update();
            }
        }
    }

    public function actionUpdateTransaction(){
        $model = Transaction::model()->findByPk($_POST['transId']);
        $model->trans_date = $_POST['transDate'];
        $model->assignAmount($_POST['amount']);
        $model->category = $_POST['category'];
        $model->description = $_POST['description'];
        $model->account_id = $_POST['account'];
        $model->type = $_POST['transType'];
        $model->memo = $_POST['memo'];
        $frequency = isset($_POST['frequency']) ? $_POST['frequency'] : null;
        if($model->update()){
            $this->createRepeatTransaction($model, $frequency);
            Utils::jsonResponse(Utils::STATUS_GOOD,'Transaction Updated', $model->id);
        }else{
            Utils::jsonResponse(Utils::STATUS_BAD,
                $this->getErrorSummaryAsText($model->getHTMLErrorSummary()));
        }
    }

    public function actionSaveUserCategory(){
        $category = Utils::getPost('usercategory');
        $catId = Utils::getPost('id');
        $prevCats = UserCategories::model()->findAllByAttributes(['name'=>$category]);
        $prevCatsCount = count($prevCats);
        $model = new UserCategories();
        $modelUpdated = false;
        if($prevCatsCount >0  && empty($catId) ){
            Utils::jsonResponse('bad',"Category exists");
        }else{
            if (!empty($catId)) {
                $model = UserCategories::model()->findByPk($catId);
                $this->updateAllTransactionsWithCategory($model->name, $category);
                $model->name = $category;
                $modelUpdated = $model->update();
            } else {
                $model = new UserCategories();
                $model->name = $category;
                $model->userid = Utils::getCurrentUserId();
                $modelUpdated = $model->save();
            }
            if ($modelUpdated) {
                Utils::jsonResponse(Utils::STATUS_GOOD, 'Category Saved', $model->name);
            } else {
                Utils::jsonResponse(Utils::STATUS_BAD,
                    $this->getErrorSummaryAsText($model->getHTMLErrorSummary()));
            }
        }

    }

    private function updateAllTransactionsWithCategory($old, $new){
        $sql = "UPDATE transactions set category='".$new
            ."' WHERE category='".$old."' AND ".Utils::queryUserAccounts();
        Yii::app()->db->createCommand($sql)->query();
    }

    public function actionDeleteTransaction(){
        $id = $_POST['id'];
        Transaction::model()->findByPk($id)->delete();
        echo 'done';
    }

    private function convertTransactionsToCalendar($accountId){
        $criteria = new CDbCriteria();
        $criteria->addCondition('type="income" or type="expense"');
        if(empty($accountId)){
            $criteria->addCondition(Utils::queryUserAccounts());
        }else{
            $criteria->addCondition('account_id='.$accountId);
        }
        $transactions = Transaction::model()->findAll($criteria);
        $calendar_dates = [];
        foreach ($transactions as $transaction){
            $calendar_dates[] = [
                'title' => $transaction->description,
                'description' => Utils::formatMoney($transaction->amount)
                    . " (" . $transaction->category. ")",
                'start' => $transaction->trans_date,
                'className' => $this->getCalendarItemClassName($transaction)
            ];
        }
        return $calendar_dates;
    }

    private function getCalendarItemClassName($transaction){
        $type = $transaction->type;
        if( $type == "expense"){
            return "fc-event-danger";
        }
        return "fc-event-success";
    }


    private function getIncomeExpenditure(){
        $labels = $this->months;
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

    private function getReportIncomeExpenditure($settings){
        $filter = $this->getReportFilterByYear($settings);
        $labels = $this->months;
        $incomeData = Queries::getIncomeByMonthWithFilter($filter);
        $income_data = $this->convert_to_months_dataset('date','total', $incomeData);
        $expenseData = Queries::getExpensesByMonthWithFilter($filter);
        $expense_data  = $this->convert_to_months_dataset('date','total', $expenseData);
        return [
            'income' => $income_data,
            'expense' => $expense_data,
            'labels' => $labels
        ];
    }

    private function getCategoryIncomeExpenditure($settings){
        $filter = $this->getReportFilterByYear($settings);
        $category = $settings['category'];
        $labels = $this->months;
        $incomeData = Queries::getCategoryIncomeByMonthWithFilter($filter, $category);
        $income_data = $this->convert_to_months_dataset('date','total', $incomeData);
        $expenseData = Queries::getCategoryExpensesByMonthWithFilter($filter, $category);
        $expense_data  = $this->convert_to_months_dataset('date','total', $expenseData);
        return [
            'income' => $income_data,
            'expense' => $expense_data,
            'labels' => $labels
        ];
    }

    public function actionGetUpdateCategoriesList(){
        echo CHtml::dropDownList('category', '', Categories::model()->getListing(),
                array('class' => 'form-control',
                    'id' => 'category', 'empty' => '--Select category--',
                    'style' => 'height:50px;width:100%'));
    }

    public function actionTransactionDetails(){
        $id = $_GET['id'];
        $model = Transaction::model()->findByPk($id);
        Utils::jsonResponse('good','good',$model->getAsJSONObject());
    }

    public function actionGetReconciliations(){
        $settings = $_GET;
        $accountId = $settings['accountId'];
        $criteria = new CDbCriteria();
        $criteria->addCondition('account_id='.$accountId);
        $criteria->addCondition('type="reconcile"');
        $transactions = Transaction::model()->findAll($criteria);
        echo $this->renderPartial('reconciliation_layout',
            ['transactions'=>$transactions]);
    }

    public function actionAddReconciliation(){
        $model = new Transaction();
        $model->trans_date = date('Y-m-d');
        $model->amount = str_replace( ',', '', $_POST['amount']); // replace thousands comma
        $model->category = $_POST['type'];
        $model->description = !empty($_POST['reason']) ? $_POST['reason'] : "Update account";
        $model->account_id = $_POST['account'];
        $model->type = "reconcile";
        if($model->save()){
            Utils::jsonResponse('good',"Reconciliation added");
        }else{
            Utils::jsonResponse('bad',
                $this->getErrorSummaryAsText($model->getHTMLErrorSummary()));
        }
    }

    public function actionRemoveReconciliation(){
        Transaction::model()->findByPk($_POST['id'])->delete();
    }

    public function actionGetAccountBalance(){
        echo $this->getAccountBalance();
    }

    public function actionGetSettingsPageData(){
        $user = Users::model()->findByPk(Utils::getCurrentUserId());
        $default_account = Utils::getCurrentUserSetting('default_account','');
        $data = [
          'username' => $user->username,
          'email' => $user->email,
            'default' => $default_account
        ];
        Utils::jsonResponse('good', "good",$data);
    }

    public function actionUpdateDefaultAccount(){
        $id = Utils::getPost('id');
        if($id){
            if(Utils::updateSetting('default_account', $id, Utils::getCurrentUserId())){
                Utils::jsonResponse('good',"Setting updated");
            }
        }
    }

    public function actionUpdateUserInfo(){
        $user = Users::model()->findByPk(Utils::getCurrentUserId());
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        if($user->update()){
            Utils::jsonResponse('good','User profile updated');
        }else{
            Utils::jsonResponse('bad',$this->getErrorSummaryAsText(
                $user->getHTMLErrorSummary()));
        }
    }

    public function actionUpdateUserPassword(){
        $oldPassword = $_POST['oldpassword'];
        $newPassword = $_POST['newpassword'];
        $confirmPassword = $_POST['confirmpassword'];
        if($oldPassword && $newPassword && $confirmPassword){
            $user = Users::model()->findByPk(Utils::getCurrentUserId());
            $ph = new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
                Yii::app()->params['phpass']['portable_hashes']);
            if(!($ph->CheckPassword($oldPassword, $user->password))) {
                Utils::jsonResponse('bad','Youve entered wrong or old password.');
            }else{
                $user->password = $ph->HashPassword($newPassword);
                if($user->update()) {
                    Utils::jsonResponse('good','Password updated');
                }
            }
        }else{
            Utils::jsonResponse('bad','Youve entered wrong old password.');
        }
    }


    public function actionGetRepeatTransactions(){
        $criteria = new CDbCriteria();
        $transactions = RepeatTransaction::model()->findAll($criteria);
        echo $this->renderPartial('repeat_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetRtDetails(){
        $id = $_GET['rtId'];
        $rt = RepeatTransaction::model()->findByPk($id);
        $model = Transaction::model()->findByPk($rt->transaction_id);
        $account = Accounts::model()->findByPk($model->account_id);
        $data = $model->getAsJsonObject();
        $data['amount'] = Utils::formatMoney($data['amount']);
        $data['header'] = $data['category'] . " - " . $account->name . "";
        $data['nextDate'] = $rt->upcoming_date;
        Utils::jsonResponse('good','Good', $data);
    }

    public function actionUpdateRt(){
        $freq = Utils::getPost('frequency');
        $date = Utils::getPost('date');
        $id = Utils::getPost('id');
        if($id && $date && $freq){
            $rt = RepeatTransaction::model()->findByPk($id);
            $rt->frequency = $freq;
            $rt->upcoming_date = $date;
            if($rt->update()){
                Utils::jsonResponse('good','Update successful');
            }else{
                Utils::jsonResponse('bad',
                    $this->getErrorSummaryAsText($rt->getHTMLErrorSummary()));
            }
        }else{
            Utils::jsonResponse('bad',"Things are missing");
        }
    }

    public function actionRemoveRT(){
        $id = Utils::getPost('id');
        if($id){
            if(RepeatTransaction::model()
                ->findByPk($id)->delete()){
                Utils::jsonResponse('good','Recurring transaction removed');
            }else{
                Utils::jsonResponse('bad',"Error occurred");
            }
        }else{
            Utils::jsonResponse('bad','No transaction selected');
        }
    }

    public function actionGetUserCategories(){

        $categories = UserCategories::model()->findAll();
        $this->renderPartial('categories_list',['categories'=>$categories]);
    }

    public function actionTest(){

    }

    /** Private function */

    private function getTopExpenses(){
        $data = Queries::getTopExpensesByYear();
        $labels = $this->convert_data_to_pie_dataset('category', $data);
        $dataset = $this->convert_data_to_pie_dataset('total',$data);
        return [
            'labels' => $labels,
            'dataset' => $dataset,
        ];
    }

    private function getAllExpenses($settings){

        $data = Queries::getAllExpensesByYear($this->getReportFilter($settings));
        $labels = $this->convert_data_to_pie_dataset('category', $data);
        $dataset = $this->convert_data_to_pie_dataset('total',$data);
        return [
            'labels' => $labels,
            'dataset' => $dataset,
            'colors' => $this->getHexColors(count($labels)),
            'percentages' => $this->convert_data_to_pie_dataset('percentage',$data)
        ];
    }

    private function convert_to_months_dataset($key, $value, $source){
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

    private function convert_data_to_pie_dataset($name, $source){
        $dataset = [];
        foreach ($source as $row){
            $dataset[] = $row[$name];
        }
        return $dataset;
    }




}
