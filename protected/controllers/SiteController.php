<?php

class SiteController extends Controller
{

    public $layout = 'secondary';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->redirect('/dashboard/');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		if(isset($_GET['completed'])){
		    $this->logout();
        }
		if(Utils::isAppSetup() == false){
            $this->redirect(array('/setup/'));
        }
        if(!Yii::app()->user->isGuest){
            $this->redirect(array('/dashboard/'));
        }

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login()) {
                Yii::app()->session['userid'] = Yii::app()->user->userid;
                $url =  $this->createUrl("/dashboard/");
                $this->redirect($url);
            }else{
                Utils::setAlert('error',$this->getErrorSummaryAsText(CHtml::errorSummary($model)));
                Utils::logger($this->getErrorSummaryAsText(CHtml::errorSummary($model)));
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
		$this->redirect('/site/login');
	}

	private function logout(){
        Yii::app()->user->logout();
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
    }

	public function actionTest(){
        $user = Utils::isAppSetup();
        if($user){
            echo "good";
        }else{
            echo "basd";
        }
    }

}
