<?php


class SetupController extends Controller
{
    public $layout = 'secondary';

    public function actionIndex(){
        if(Yii::app()->params["setup"] == "true"){
            $this->redirect(array('/site/login'));
        }
        $form = new SetupForm();
        $form->setScenario("db");
        if(isset($_POST['SetupForm'])){
            $form->attributes = $_POST['SetupForm'];
            if($form->validate()){
                $this->createDatabaseConfig($form);
                $this->redirect('/setup/createtables');
            }
        }
        $this->render('index',['model'=>$form]);
    }

    public function actionCreateTables(){
        $form = new SetupForm();
        if(Yii::app()->params["setup"] == "true"){
            $this->redirect(array('/site/login'));
        }
        if($form->create_tables()){
            $this->redirect('/setup/user');
        }else{
            echo $form->errorMessage;
        }
    }

    private function createDatabaseConfig(SetupForm $form){
        $file =  Yii::app()->basePath.'/../protected/config/database-copy.php';
        $replacement =  Yii::app()->basePath.'/../protected/config/database.php';
        $updated = str_replace(
            ["{dbname}","{host}","{username}","{password}"],
            [$form->dbname,$form->getDatabaseHost(), $form->dbuser, $form->dbpassword],
            file_get_contents($file));
        file_put_contents($replacement, $updated);
    }

    private function updateAppConfig(SetupForm $form){
        $file =  Yii::app()->basePath.'/../protected/config/main-copy.php';
        $replacement =  Yii::app()->basePath.'/../protected/config/main.php';
        $updated = str_replace(
            ["{setup}","{appname}"],
            ["true","My Purdm"],
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
        if(Yii::app()->params["setup"] == "true"){
            $this->redirect(array('/site/login'));
        }
        $form = new SetupForm();
        $form->setScenario("user");
        if(isset($_POST['SetupForm'])){
            $form->attributes = $_POST['SetupForm'];
            if($form->validate()){
                $user = $this->createUser($form);
                if($user->hasErrors()){

                }else{
                    $this->updateAppConfig($form);
                    $this->redirect('/setup/completed/'. $user->id);
                }
            }
        }
        $this->render('user',['model'=>$form]);
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
        $file= "/etc/cron.d/wfcron";
        $fp = fopen($file, 'w+');
        fwrite($fp, '1');
        fwrite($fp, '23');
        fclose($fp);
    }

    public function actionUpdate(){
        $form = new SetupForm();
        $form->update_tables();
        if($form->errorMessage){
            throw new CHttpException(404, $form->errorMessage);
        }
    }
}
