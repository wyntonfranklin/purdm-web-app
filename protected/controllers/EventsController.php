<?php

class EventsController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }


    public function actionCreate()
	{
	    $model = new Event();
        if(isset($_POST['Event'])){
            $model->attributes = $_POST["Event"];
            $model->save();
        }
		$this->render('create',['model'=>$model]);
	}

	public function actionView(){
        echo "viewing a event";
    }

}