<?php


class SettingsController extends Controller
{
    public $layout='//layouts/primary';

    public function actionIndex(){
        $this->redirect('/settings/notifications');
    }

    public function actionNotifications(){
        $this->render('notifications');
    }

    public function actionAccount(){
        $this->render('account');
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

    public function settingsMenuActive( $menu )
    {
        $action = Yii::app()->controller->action->id;
        if ($action ==  $menu) {
            return "active";
        }
    }
}
