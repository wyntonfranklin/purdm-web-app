<?php

class DashboardController extends Controller
{

    public $layout='//layouts/primary';

    public function actionIndex(){
        $this->render('index');
    }

}
