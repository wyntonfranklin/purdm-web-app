<?php

class HomeController extends Controller
{
    public $pageTitle = 'This is the page title';

    public function actionIndex(){
        echo "this is the home";
    }

    public function actionFeatures(){
        echo "this is the features page";
    }
}