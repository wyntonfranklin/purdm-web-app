<?php


class CategoryController extends Controller
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
                'actions'=>array(''),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('report'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionReport($name=""){
        $category = Categories::model()->findByAttributes(['name'=>strtolower($name)]);
        if($category == null ){
            $category = UserCategories::model()->findByAttributes(['name'=>strtolower($name)]);
        }
        $this->render('report',['model'=>$category]);
    }
}
