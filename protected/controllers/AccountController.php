<?php


class AccountController extends Controller
{
    public $layout='//layouts/primary';

    public function actionIndex(){

        $this->render('index');
    }

    public function actionCreate(){

        if(isset($_POST['accountName'])){
            $account = new Accounts();
            $account->name = $_POST['accountName'];
            if( $account->save() ){
                if(isset($_POST['accountFunds'])){
                    $this->createDefaultReconciliation($account, $_POST['accountFunds']);
                }
                $this->redirect($account->getAccountViewUrl());
            }
        }
        $this->render('create');
    }

    private function createDefaultReconciliation( $account, $amount ){
        $model = new Transaction();
        $model->trans_date = date('Y-m-d');
        $model->amount = str_replace( ',', '', $amount); // replace thousands comma
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
