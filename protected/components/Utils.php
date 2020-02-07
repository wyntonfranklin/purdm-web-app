<?php


class Utils
{

    const STATUS_GOOD = 'good';
    const STATUS_BAD = 'bad';
    const ALERT_SUCCESS ="success";
    const ALERT_INFO = "info";
    const ALERT_ERROR = "error";
    const APP_ASSETS_VERSION = '0.0.1';

    public static function setAlert($type, $message)
    {
        Yii::app()->user->setFlash($type, $message);
    }

    public static function formatMoney($value){
      // return money_format('%.2n', $value);
      // return "$" . sprintf('%01.2f', $value);
        return '$' . number_format($value, 2);
    }

    public static function getMonth(){
        return date('M');
    }

    public static function getNumMonth(){
        return date('m');
    }

    public static function getYear(){
        return date('Y');
    }

    public static function getTransactionIcon($type){
        if($type == 'expense'){
            return '<i style="color:darkred;" class="fa fa-minus"></i>';
        }else{
            return '<i style="color:green;" class="fa fa-plus"></i>';
        }
    }

    public static function getReconcileIcon($type){
        if($type == 'minus'){
            return '<i style="color:darkred;" class="fa fa-minus"></i>';
        }else{
            return '<i style="color:green;" class="fa fa-plus"></i>';
        }
    }

    public static function getUserAccounts(){

    }

    public static function queryUserAccounts($col='account_id'){
        $query = "$col IN(";
        $accounts = Accounts::model()->getUserAccounts();
        foreach ($accounts as $account){
            $query .= $account->id . ",";
        }
        $query = rtrim($query,",");
        return $query . ")";
    }

    public static function pageSettings($settings=array()){
        $formattedSettings = json_encode($settings);
        $o = "<input type='hidden' id='page-settings' data-settings='$formattedSettings' />";
        return $o;
    }

    public static function logger($message, $tag='console'){
        Yii::log($message, CLogger::LEVEL_ERROR, $tag);
    }

    public static function getCurrentUserId(){
        return Yii::app()->user->userid;
    }

    public static function setCurrentUserId($id){
        Yii::app()->user->userid = '1';
    }

    public static function getCurrentUserRole(){
        if(!empty(Yii::app()->user->role)){
            return Yii::app()->user->role;
        }else{
            return "normal";
        }
    }

    public static function getUserName(){
        return Users::model()->findByPk(self::getCurrentUserId())->username;
    }

    public static function jsonResponse($status, $message, $data=""){
        echo json_encode(['response'=>[
            'message' => $message,
            'status' => $status,
            'data' => $data
        ]]);
    }

    public static function getCurrentUrl(){
        return Yii::app()->request->url;
    }

    public static function renderCssAssets(){
        $file = "/public/assets/css/styles.css";
        if(YII_DEBUG){
            Yii::app()->controller->renderPartial('//layouts/css_assets');
        }else{
            Yii::app()->clientScript->registerCssFile($file);
        }
    }

    public static function renderJsAssets(){
        $file= "/public/assets/js/built.js";
        if(YII_DEBUG){
            Yii::app()->controller->renderPartial('//layouts/js_assets');
        }else{
            Yii::app()->clientScript->registerScriptFile($file);
        }
    }

    public static function registerCustomScripts($scripts=array(),$end=false){
        foreach ($scripts as $script){
            self::registerJs($script);
        }
    }

    public static function registerPageJs( $file )
    {
        if(YII_DEBUG){
            $file = "/js/pages/{$file}.js?v=" .self::getAssetsVersion();
        }else{
            $file = "/public/assets/js/pages/{$file}.js?v=". self::getAssetsVersion();
        }
        Yii::app()->clientScript->registerScriptFile($file,
            CClientScript::POS_END);
    }

    public static function registerJs($file){
        if(YII_DEBUG){
            $file = "/js/{$file}.js?v=" .self::getAssetsVersion();
        }else{
            $file = "/public/assets/js/{$file}.js?v=". self::getAssetsVersion();
        }
        Yii::app()->clientScript->registerScriptFile($file,
            CClientScript::POS_END);
    }

    private static function getAssetsVersion()
    {
        return self::APP_ASSETS_VERSION;
    }

    public static function createUrl($path, $params=array()){
        return Yii::app()->createUrl($path, $params);
    }

    public static function getPost($key, $default= null){
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public static function getUserSetting($value, $id, $default=null){
        $setting = Settings::model()->findByAttributes(['user_id'=>$id,'setting_name'=>$value]);
        if($setting == null ){
            return $default;
        }else{
            return $setting->setting_value;
        }
    }

    public static function getCurrentUserSetting($value, $default=null){
        return self::getUserSetting($value, self::getCurrentUserId(), $default);
    }

    public static function updateSetting($name, $value, $id){
        $setting = Settings::model()->findByAttributes(['user_id'=>$id,'setting_name'=>$name]);
        $status = false;
        if($setting == null ){
            $setting = new Settings();
            $setting->user_id = $id;
            $setting->setting_name = $name;
            $setting->setting_value = $value;
            $status = $setting->save();
        }else{
            $setting->setting_value = $value;
            $status = $setting->update();
        }
        if($status){
            return true;
        }
        return false;
    }

    public static function dbLogger($name, $val='test'){
        $setting = new Settings();
        $setting->setting_name = $name;
        $setting->setting_value = $val;
        $setting->save();
    }

    public static function getApiKey(){
        $key = self::randomString(15);
        return $key;
    }

    public static function randomString($len=30){
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $len; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }

    public static function getErrorSummaryAsText($summary){
        $output = "";
        if(!empty($summary)){
            $dom = new domDocument;
            $dom->loadHTML($summary);
            $items = $dom->getElementsByTagName('li');
            foreach ($items as $row) {
                $output .= $row->nodeValue . "\r\n";
            }
            return $output;
        }
        return "";
    }

    public static function runTasks(){
        $params = "";
        $basePath = Yii::app()->basePath;
        $params .= $basePath;
        $fullpath = $basePath . "/cron.sh {$params}  > /dev/null 2> /dev/null &";
        exec($fullpath);
    }

    public static function updateApp($source="", $destination=""){
        $basePath = Yii::app()->basePath;
        $params = $source . " " . $destination;
        $fullCommand = $basePath . "/update.sh {$params}  > /dev/null 2> /dev/null &";
        exec($fullCommand);
    }

    public static function isMenuOpen($area="body"){
        if(isset($_COOKIE["menuopen"]) && $_COOKIE["menuopen"] == "no"){
            if($area == "body"){
                return "sidebar-toggled";
            }
            if($area == "menu"){
                return  "toggled";
            }
        }
    }

    public static function getBaseName($url){
        $name = basename($url); // to get file name
        return $name;
    }

    public static function getUpdatesAsArray($url){
        $updates = array();
        $handle = fopen($url, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
               $updates[] = $line;
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
        return $updates;
    }
}
