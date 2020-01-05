<?php


class SettingsController extends Controller
{
    public $layout='//layouts/primary';

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
                'actions'=>array(''),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index','notifications','general',
                    'profile','backups','help','repeat','categories'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex(){
        $this->redirect('/settings/general');
    }

    public function actionCategories(){
        $this->render('categories');
    }

    public function actionNotifications(){
        $this->render('notifications');
    }

    public function actionGeneral(){
        $this->render('general');
    }

    public function actionProfile(){
        $this->render('profile');
    }

    public function actionBackups(){
        $this->render('backups');
    }

    public function actionMembership(){
        $this->render('membership');
    }

    public function actionHelp(){
        $this->render('help');
    }

    public function actionRepeat(){
        $transactions = RepeatTransaction::model()->findAll();
        $this->render('repeat_transactions',['transactions'=>$transactions]);
    }

    public function settingsMenuActive( $menu )
    {
        $action = Yii::app()->controller->action->id;
        if ($action ==  $menu) {
            return "active";
        }
    }
}
