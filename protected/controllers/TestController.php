<?php

Yii::import('application.extensions.*');
require_once('phpexcel/JPhpExcel.php');
require_once('phpexcelreader/JPhpExcelReader.php');
require_once('spreadsheet-reader-master/SpreadsheetReader.php');

class TestController extends Controller
{

    public function actionIndex(){

        $dir = 'C:\Users\wfranklin\Documents\GitHub\wfexpenses\temp\testaccount3.xls';
        //$data=new JPhpExcelReader($dir);
        $Reader = new SpreadsheetReader($dir);
        $Sheets = $Reader -> Sheets();

        foreach ($Sheets as $Index => $Name)
        {
            echo 'Sheet #'.$Index.': '.$Name;

            $Reader -> ChangeSheet($Index);

            foreach ($Reader as $Row)
            {
                print_r($Row);
            }
        }
    }

    public function actionBackups(){
        $path = Yii::app()->basePath.'/../backup';
        $files = array();
        if ($handle = opendir($path)) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {
                    $files[] = $entry;
                 //   echo "$entry\n";
                }
            }

            closedir($handle);
        }
        var_dump($files);
    }

    public function actionTask(){
        $basePath = Yii::app()->basePath;
        $params = "";
        $command = "php " . $basePath .  DIRECTORY_SEPARATOR ."yiic backup db $params > /dev/null 2> /dev/null &";
        echo $command;
        //exec($command);
    }


}