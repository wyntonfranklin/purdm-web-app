<?php


class SettingsController extends Controller
{
    public $layout='//layouts/primary';

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
                'actions'=>array(''),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index','notifications','general',
                    'profile','backups','help','repeat','categories','test','downloadtransactions'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex(){
        $this->redirect('/settings/general');
    }

    public function actionCategories(){
        $this->render('categories');
    }

    public function actionNotifications(){
        $this->render('notifications');
    }

    public function actionGeneral(){
        $this->render('general');
    }

    public function actionProfile(){
        $this->render('profile');
    }

    public function actionBackups(){
        $this->render('backups');
    }

    public function actionMembership(){
        $this->render('membership');
    }

    public function actionHelp(){
        $this->render('help');
    }

    public function actionRepeat(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('transaction_id IN (Select transaction_id 
        from transactions where account_id ('.Utils::queryUserAccounts().'))');
        $transactions = RepeatTransaction::model()->findAll();
        $this->render('repeat_transactions',['transactions'=>$transactions]);
    }

    public function settingsMenuActive( $menu )
    {
        $action = Yii::app()->controller->action->id;
        if ($action ==  $menu) {
            return "active";
        }
    }

    public function actionDownloadTransactions($f="mytransactions"){
        $criteria = new CDbCriteria();
        //$criteria->addCondition('type="income" or type="expense"');
        $criteria->addCondition(Utils::queryUserAccounts());
        $criteria->order = 'trans_date DESC';
        $transactions = Transaction::model()->findAll($criteria);
        $this->createExcelFromTransactions($transactions, $f);
    }

    private function createExcelFromTransactions($transactions, $filename){
        $data = array();
        $i=0;
        $data[$i]['trans_date'] = 'Date';
        $data[$i]['amount'] = 'Amount';
        $data[$i]['description'] = 'Description';
        $data[$i]['category'] = 'Category';
        $data[$i]['account'] = 'Account';
        $data[$i]['type'] = 'Type';
        $data[$i]['memo'] = 'Memo';
        $i++;
        foreach($transactions as $transaction){
            $data[$i]['trans_date'] = $transaction->trans_date;
            $data[$i]['amount'] = $transaction->amount;
            $data[$i]['description'] = $transaction->description;
            $data[$i]['category'] = $transaction->category;
            $data[$i]['account'] = $transaction->getAccountName();
            $data[$i]['type'] = $transaction->type;
            $data[$i]['memo'] = $transaction->memo;
            $i++;
        }
        $excel = new ExcelAdapter();
        $excel->createExcel($data,$filename);
    }
}
