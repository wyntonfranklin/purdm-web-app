<?php


class CategoryController extends Controller
{


    public function actionView($id=""){
        $category = Categories::model()->findByAttributes(['name'=>strtolower($id)]);
        if($category == null ){
            $category = UserCategories::model()->findByAttributes(['name'=>strtolower($id)]);
        }
        $this->render('view',['model'=>$category]);
    }
}
