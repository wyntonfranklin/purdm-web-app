<?php


class AccountController extends Controller
{
    public $layout='//layouts/primary';

    public function actionIndex(){

        $this->render('index');
    }

    public function actionCreate(){

        $this->render('create');
    }

    public function actionView($id=""){

        $this->render('view');
    }
}
