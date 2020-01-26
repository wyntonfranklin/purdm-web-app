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

    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('appname, dbname, dbuser, dbhost, dbpassword, username, email, password', 'safe'),
        );
    }

    public function create_tables(){
        $file =  Yii::app()->basePath.'/../sql/on_install.sql';
        $contents = file_get_contents($file);
        //echo $contents;
        $results = Yii::app()->db->createCommand($contents)->query();
    }


}
