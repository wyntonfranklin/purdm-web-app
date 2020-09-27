<?php


class AjaxController extends QueriesController
{


    public function actions()
    {
        return array(
            'DownloadUpdate'=>'application.components.UpdateAction',
        );
    }


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

    private function save_general_transactions(){
        $model = $this->assign_transaction_attributes();
        $model->setScenario('save-trans');
        $frequency = isset($_POST['frequency']) ? $_POST['frequency'] : null;
        if($model->save()){
            if(!empty($frequency)){
                $this->createRepeatTransaction($model, $frequency);
            }
            Utils::jsonResponse(Utils::STATUS_GOOD,'Transaction successfully saved');
        }else{
            Utils::logger( CHtml::errorSummary($model));
            Utils::jsonResponse(Utils::STATUS_BAD,
                $this->getModelErrorSummaryAsText($model));
        }
    }

    private function assign_transaction_attributes(){
        $model = new Transaction();
        $model->trans_date = $_POST['transDate'];
        $model->assignAmount($_POST['amount']);
        $model->amount = $_POST['amount'];
        $model->category = $_POST['category'];
        $model->description = $_POST['description'];
        $model->account_id = $_POST['account'];
        $model->type = $_POST['transType'];
        $model->memo = $_POST['memo'];
        return $model;
    }

    private function transfer_transaction(){
        $incomeModel = $this->assign_transaction_attributes();
        $incomeModel->setScenario("save-trans");
        $incomeModel->type = "income";
        $incomeModel->account_id = $_POST["account_to"];
        $expenseModel = $this->assign_transaction_attributes();
        $expenseModel->setScenario('save-trans');
        $expenseModel->type = "expense";
        if($incomeModel->save() && $expenseModel->save()){
            Utils::jsonResponse(Utils::STATUS_GOOD,'Transaction successfully saved');
        }else{
            //Utils::logger( CHtml::errorSummary($model));
            //Utils::jsonResponse(Utils::STATUS_BAD,
              //  $this->getErrorSummaryAsText($model->getHTMLErrorSummary()));
        }
    }

    public function actionSaveTransaction(){
        $transtype = isset($_POST['transType']) ? $_POST['transType'] : null;
        if($transtype == "expense" || $transtype == "income"){
            $this->save_general_transactions();
        }else if($transtype == "transfer"){
            $this->transfer_transaction();
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
                $this->getModelErrorSummaryAsText($model));
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
                    $this->getModelErrorSummaryAsText($model));
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
                $this->getModelErrorSummaryAsText($model));
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
            Utils::jsonResponse('bad',$this->getModelErrorSummaryAsText(
                $user));
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
        $criteria->addCondition('transaction_id IN (Select transaction_id 
        from transactions where ('.Utils::queryUserAccounts().'))');
        $transactions = RepeatTransaction::model()->findAll($criteria);
        echo $this->renderPartial('repeat_transactions',
            ['transactions'=>$transactions]);
    }

    public function actionGetAllUsers(){
        $users = Users::model()->findAll();
        echo $this->renderPartial('users_layout',
            ['users'=>$users]);
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
                    $this->getModelErrorSummaryAsText($rt));
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


    public function actionGetApiKey(){
        $setting = Utils::getCurrentUserSetting('api_key','');
        Utils::jsonResponse('good','good', ['apiKey'=> $setting]);
    }

    public function actionGenerateApiKey(){
        $apiKey = Utils::getApiKey();
        if(Utils::updateSetting('api_key',$apiKey, Utils::getCurrentUserId())){
            Utils::jsonResponse('good','good',['apiKey'=>$apiKey]);
        }

    }

    public function actionBulkUpload(){
        $log = "";
        $file = CUploadedFile::getInstanceByName('file');
        $acc = Utils::getPost('accounts');
        $createAccount =  isset($_POST['create']) ? true : false;
        if($file->type!='application/vnd.ms-excel'){
            echo Utils::jsonResponse('bad','File is wrong format',[]);
        }else{
            try{
                $path = Yii::app()->basePath.  DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR .
                    'temp'. DIRECTORY_SEPARATOR . $file->name;
                $file->saveAs($path);
                $excel = new ExcelAdapter();
                $data = $excel->getRows($path);
                $transactions = $data->sheets[0]['cells'];
                for($i=2; $i<=count($transactions);$i++){
                    $cols = $excel->assignTransactionsCols($transactions[$i]);
                    $model = new Transaction();
                    $model->setScenario("save-trans");
                    $model->trans_date = $cols["transDate"];
                    $model->amount = $cols["amount"];
                    $model->description = $cols["description"];
                    $model->category = $cols["category"];
                    if($acc == "byname"){
                        $aname = Accounts::model()->getAccountByName($cols["account"]);
                        if($aname == null && $createAccount){
                            $account = new Accounts();
                            $account->name = $cols["account"];
                            $account->user_id = Utils::getCurrentUserId();
                            if($account->save()){
                                $model->account_id = $account->id;
                            }else{
                                $log .= $this->getModelErrorSummaryAsText($account);
                            }
                        }else{
                            $model->account_id = "";
                        }
                    }else{
                        $model->account_id = $acc;
                    }
                    $model->type = $cols["type"];
                    $model->memo = $cols["memo"];
                    if($model->save()){
                        $log .= "Transaction ".$model->description . "[" .$model->amount
                            ."] saved as id:" .$model->transaction_id. ". to the account\r\n";
                    }else{
                        $log .= "Error saving transaction - ".$model->description."(".$model->amount."). Error is: " .
                            $this->getModelErrorSummaryAsText($model) . "\r\n";
                    }
                }
                echo Utils::jsonResponse('good','good', ['post'=>$_POST,'log'=>$log]);
            }catch (Exception $e){
                echo Utils::jsonResponse('bad',$e->getMessage(),[]);
            }
        }
    }

    public function actionGetAllUsersData(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($id){
            $user = Users::model()->findByPk($id);
            Utils::jsonResponse('good','good',[
                'username' => $user->username,
                'email' => $user->email,
            ]);
        }
    }

    public function actionAdminChangeUserPassword(){
        $id = Utils::getPost("id");
        $password = Utils::getPost("password");
        if($id && $password){
            $user = Users::model()->findByPk($id);
            $ph = new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
                Yii::app()->params['phpass']['portable_hashes']);
            $user->password = $ph->HashPassword($password);
            if($user->update()){
                Utils::jsonResponse('good','Password updated',[]);
            }else{
                Utils::jsonResponse('bad',
                    $this->getModelErrorSummaryAsText($user));
            }
        }else{
            Utils::jsonResponse('bad','All values not submitted correctly');
        }
    }

    public function actionAdminUpdateUser(){
        $id = Utils::getPost("id");
        if(empty($id)){
            $user = new Users('create-user');
        }else{
            $user = Users::model()->findByPk($id);
            $user->setScenario('create-user');
        }
        $user->username = Utils::getPost('username');
        $user->email = Utils::getPost('email');
        $user->assignUserType(Utils::getPost('usertype'));
        if($user->isNewRecord && $user->save()){
            echo Utils::jsonResponse(Utils::STATUS_GOOD,"User created",
                ['id'=>$user->id]);
        }else if(!$user->isNewRecord && $user->update()){
            echo Utils::jsonResponse(Utils::STATUS_GOOD,"User updated",
                ['id'=>$user->id]);
        }else{
            echo Utils::jsonResponse(Utils::STATUS_BAD,
                $this->getModelErrorSummaryAsText($user));
        }
    }


    public function actionGetUpdates(){

        $updater = new PDMUpdater();
        if($updater->getUpdates()){
            $data = json_decode($updater->response, TRUE);
            $links = $data["updates"];
            Utils::jsonResponse('good', 'good',
                $this->renderPartial('updates_layout',['links'=>$links], true)
            );
        }else{
            Utils::jsonResponse('bad',$updater->getErrorMessage());
        }
    }

    public function actionGetPreviousBackups(){
        $path = Yii::app()->basePath.'/../backup';
        $baseUrl = Yii::app()->baseUrl;
        $files = $this->getBackups($path);
        $o = "";
        foreach($files as $file){
            $o.= "<li class=\"list-group-item\"><a href='" . $baseUrl . "/backup/$file".  "'>$file</a></li>";
        }
        echo Utils::jsonResponse(Utils::STATUS_GOOD,"good",
            ['html'=>$o]);

    }

    public function actionStartBackup(){
        if(Yii::app()->request->isPostRequest){
            try{
                $name = Utils::getPost("filename");

                $basePath = Yii::app()->basePath;
                $params = "";
                if($name){
                    $params.= "--name=".$name;
                }
                $command = "php " . $basePath .  DIRECTORY_SEPARATOR ."yiic backup db $params";
                exec($command);
                Utils::jsonResponse('good','Backup successfully started. Refresh listing',[]);
            }catch (Exception $e){
                Utils::jsonResponse('bad',$e->getMessage());
            }
        }else{
            Utils::jsonResponse('bad',"Request is invalid");
        }
    }

    private function getBackups($path){
        $files = array();
        if ($handle = opendir($path)) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {
                    $files[] = $entry;
                    //   echo "$entry\n";
                }
            }

            closedir($handle);
        }
        return $files;
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





}
