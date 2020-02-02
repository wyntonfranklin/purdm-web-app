<?php


class UsersController extends Controller
{

    public $layout='//layouts/primary';


    public function actionIndex(){

        $users = Users::model()->findAll();
        $this->render('index',['users'=>$users]);
    }


}
