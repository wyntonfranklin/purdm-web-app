<?php


class AccountController extends Controller
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
                'actions'=>array('index','create','update','view',
                    'close','Transactions','Reconciliation'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex(){

        $this->render('index');
    }

    public function actionCreate(){

        if(isset($_POST['accountName'])){
            $account = new Accounts();
            $account->name = $_POST['accountName'];
            $account->user_id = Utils::getCurrentUserId();
            $account->currentBalance = isset($_POST['accountFunds']) ? $_POST['accountFunds'] : null;
            if( $account->save() ){
                if(!empty($account->currentBalance)){
                    $this->createDefaultReconciliation($account);
                }
                Utils::setAlert(Utils::ALERT_SUCCESS,"Account successfully created");
                $this->redirect($account->getAccountViewUrl());
            }else{
                Utils::logger($account->getHTMLErrorSummary());
                Utils::setAlert(Utils::ALERT_ERROR,
                    $this->getErrorSummaryAsText($account->getHTMLErrorSummary()));
            }
        }
        $this->render('create');
    }

    private function createDefaultReconciliation( Accounts $account ){
        $model = new Transaction();
        $model->trans_date = date('Y-m-d');
        $model->amount = str_replace( ',', '', $account->currentBalance); // replace thousands comma
        $model->category = "add";
        $model->description = "Starting balance";
        $model->account_id = $account->id;
        $model->type = "reconcile";
        $model->save();
    }

    public function actionUpdate($id=""){

        $account = Accounts::model()->findByPk($id);
        if(isset($_POST['accountName'])){
            $account->name = $_POST['accountName'];
            if($account->update()){
                $this->redirect($account->getAccountViewUrl());
            }
        }
        $this->render('update',['model'=>$account]);
    }

    public function actionView($id=""){
        $account = Accounts::model()->findByPk($id);
        if($account !== null ){
            $this->render('view',['model'=>$account]);
        }
    }

    public function actionClose($id=""){
        $account = Accounts::model()->findByPk($id);
        if($account !== null ){
            if(isset($_POST['delete-account'])){
                if($account->delete()){
                    if( Transaction::model()->deleteByAccount($id)){
                        Utils::setAlert(
                            Utils::ALERT_INFO, "Account removed"
                        );
                    };
                    $this->redirect('/dashboard/');
                }
            }
            $this->render('close',['model'=>$account]);
        }
    }

    public function actionTransactions($id){
        $account = Accounts::model()->findByPk($id);
        $this->render('transactions',['model'=>$account]);
    }

    public function actionReconciliation($id){
        $account = Accounts::model()->findByPk($id);
        $this->render('reconciliation',['model'=>$account]);
    }
}
