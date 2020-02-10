<?php


class SetupForm extends CFormModel
{

    public $appname;
    public $dbname;
    public $dbuser;
    public $dbhost;
    public $dbpassword;
    public $username;
    public $email;
    public $password;
    public $errorMessage;

    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('dbname, dbuser, dbhost', 'required','on'=>'db'),
            array('username, email, password','required','on'=>'user'),
            array('appname, dbname, dbuser, dbhost, dbpassword, username, email, password', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'dbname'=>'Database Name',
            'dbuser' => 'Database User',
            'dbhost' => 'Database Host',
            'dbpassword' => 'Database Password',
            'appname' => 'App name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password'
        );
    }

    public function create_tables(){
        $file =  Yii::app()->basePath.'/../sql/on_install.sql';
        $contents = file_get_contents($file);
        try{
            Yii::app()->db->createCommand($contents)->query();
            return true;
        }catch (Exception $e){
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function update_tables(){
        $file =  Yii::app()->basePath.'/../sql/on_update.sql';
        $contents = file_get_contents($file);
        try{
            Yii::app()->db->createCommand($contents)->query();
            return true;
        }catch (Exception $e){
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function getDatabaseHost(){
        if($this->dbhost){
            return $this->dbhost;
        }
        return "127.0.0.1";
    }

    public function validateDatabaseConnnection(){
        $sql = "SELECT * FROM settings";
        try{
            Yii::app()->db->createCommand($sql)->query();
            return true;
        }catch (Exception $e){
            $this->errorMessage = $e->getMessage();
            return false;
        }
        return false;
    }


}
