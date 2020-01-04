<?php


class CategoryController extends Controller
{


    public function actionReport($name=""){
        $category = Categories::model()->findByAttributes(['name'=>strtolower($name)]);
        if($category == null ){
            $category = UserCategories::model()->findByAttributes(['name'=>strtolower($name)]);
        }
        $this->render('report',['model'=>$category]);
    }
}
