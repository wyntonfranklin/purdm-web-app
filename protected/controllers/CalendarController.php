<?php


class CalendarController extends Controller
{

    public $layout='//layouts/primary';

    public function actionIndex(){
        $this->render('index');
    }
}
