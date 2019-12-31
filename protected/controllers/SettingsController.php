<?php


class SettingsController extends Controller
{
    public $layout='//layouts/primary';

    public function actionIndex(){
        $this->redirect('/settings/general');
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
