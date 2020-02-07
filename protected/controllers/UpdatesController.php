<?php


class UpdatesController extends Controller
{


    public function actionInstall(){
        $this->runUpdateTask();
    }

    public function actionVersion(){
        echo PURDM_VERSION;
    }


    public function runUpdateTask(){
        $downloadUrl = "https://wfspace.sfo2.digitaloceanspaces.com/wfexpenses0.0.1.tar";
        $filename = Utils::getBaseName($downloadUrl);
        $zipDownloadPath = Yii::app()->basePath . '/../temp/' . $filename;
        file_put_contents($zipDownloadPath, fopen($downloadUrl, 'r'));
        $zdestination =  Yii::app()->basePath . '/../temp/';
        $command = "tar -xvf ". $zipDownloadPath . " -C ". $zdestination;
        $source = Yii::app()->basePath . '/../temp/'
            . pathinfo($filename, PATHINFO_FILENAME). "/";
        $destination = Yii::app()->basePath . '/../';
        exec($command, $log);
       // Utils::updateApp($source, $destination); // from updates folder;
    }



    public function actionTest(){
        $handle = fopen("http://www.igestdevelopment.com/updates_log", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                echo $line ."<br>";
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
    }




}
