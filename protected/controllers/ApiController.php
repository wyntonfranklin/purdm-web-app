<?php


class ApiController extends QueriesController
{


    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function beforeAction($action)
    {
        $userid = new ApiUserIdentity('name','password');
        $userid->authenticate();
        Yii::app()->user->login($userid,0);
        Yii::app()->session['userid'] = Yii::app()->user->userid;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionGet(){
        $action = $_GET['action'];
        if($action == 'ie'){
            $this->appGetIEThisMonth();
        }
    }


    public function actionPost(){
        $action = $_GET['action'];
        if($action == 'create_transaction'){
            $this->appCreateTransaction();
        }
    }

    public function appGetIEThisMonth(){
        $data = [
            'income' => $this->getIncomeThisMonth(),
            'expenses' => $this->getExpenses(),
            'worth' => $this->getNetWorth(),
            'savings' => $this->getSavings()
        ];
        Utils::jsonResponse('good','good',$data);
    }

    public function appGetExpenseThisMonth(){

    }

    public function appGetIncomeThisMonth(){

    }

    public function appCreateTransaction(){

    }

    public function actionGetCredentials(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $record = Users::model()->findByAttributes(array('email'=>$email));
        $apiKey = Utils::getUserSetting('api_key', $record->id,"");
        $ph=new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
            Yii::app()->params['phpass']['portable_hashes']);
        if(!$ph->CheckPassword($password, $record->password)){
            Utils::jsonResponse('bad','User name or password incorrect');
        }else if(empty($apiKey)){
            Utils::jsonResponse('bad','No api key is setup for this user');
        }else{

        }   Utils::jsonResponse('good','good', ['apiKey'=>$apiKey]);
    }


}
