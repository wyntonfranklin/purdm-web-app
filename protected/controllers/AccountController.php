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
            $account->type = $_POST['accountType'];
            $account->save();
            $this->redirect('/dashboard/');
        }
        $this->render('create');
    }

    public function actionUpdate(){

        if(isset($_POST['accountName'])){
            $account = new Accounts();
            $account->name = $_POST['accountName'];
            $account->type = $_POST['accountType'];
            $account->save();
            $this->redirect('/dashboard/');
        }
        $this->render('update');
    }

    public function actionView($id=""){
        $account = Accounts::model()->findByPk($id);
        if($account !== null ){
            $this->render('view',['model'=>$account]);
        }
    }
}
