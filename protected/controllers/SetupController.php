<?php


class SetupController extends Controller
{
    public $layout = 'secondary';

    public function actionIndex(){
        $form = new SetupForm();
        if(isset($_POST['SetupForm'])){
            $form->attributes = $_POST['SetupForm'];
            $this->createDatabaseConfig($form);
            $this->redirect('/setup/createtables');
        }else{
            $this->render('index',['model'=>$form]);
        }
    }

    public function actionCreateTables(){
        $form = new SetupForm();
        $form->create_tables();
        $this->redirect('/setup/user');
    }

    private function createDatabaseConfig(SetupForm $form){
        $file =  Yii::app()->basePath.'/../protected/config/database-copy.php';
        $replacement =  Yii::app()->basePath.'/../protected/config/database.php';
        $updated = str_replace(
            ["{dbname}","{host}","{username}","{password}"],
            [$form->dbname,"127.0.0.1", $form->dbuser, $form->dbpassword],
            file_get_contents($file));
        file_put_contents($replacement, $updated);
    }

    private function configApp(SetupForm $form){
        $file =  Yii::app()->basePath.'/../protected/config/database-copy.php';
        $replacement =  Yii::app()->basePath.'/../protected/config/database.php';
        $updated = str_replace(
            ["{dbname}","{host}","{username}","{password}"],
            [$form->dbname,"127.0.0.1", $form->dbuser, $form->dbpassword],
            file_get_contents($file));
        file_put_contents($replacement, $updated);
    }

    public function actionUser(){
        $form = new SetupForm();
        if(isset($_POST['SetupForm'])){
            $form->attributes = $_POST['SetupForm'];
            $user = $this->createUser($form);
            if($user->hasErrors()){

            }else{
                $this->redirect('/setup/completed/'. $user->id);
            }
        }else{
            $this->render('user',['model'=>$form]);
        }
    }

    public function createUser(SetupForm $form){
        $user = new Users();
        $user->username = $form->username;
        $user->email = $form->email;
        $user->createdAt = date("Y-m-d h:i:s");
        $ph = new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
            Yii::app()->params['phpass']['portable_hashes']);
        $user->password = $ph->HashPassword($form->password);
        $user->save();
        return $user;

    }

    public function actionCompleted($id=""){
        $user = Users::model()->findByPk($id);
        if($user == null ){

        }else{
            $this->render('completed',['model'=>$user]);
        }
    }

    public function actionTest(){
        $form = new SetupForm();
    }
}
