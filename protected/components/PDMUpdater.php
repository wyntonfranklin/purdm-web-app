<?php


class PDMUpdater
{

    private $downloadUrl;
    private $basePath;
    const TEMP_FOLDER = "temp";

    /**
     * PDMUpdater constructor.
     */
    public function __construct( $url="" )
    {
        if($url){
            $this->setDownloadUrl($url);
        }
        $this->basePath = Yii::app()->basePath;
    }

    public function createTempFolder(){
        if (!file_exists($this->getTarBasePath())) {
            mkdir($this->getTarBasePath(), 0777, true);
        }
    }

    public function downloadUpdatePackage(){
        $this->downloadFile();
    }

    public function update(){
        if(!$this->downloadUrl){

        }else{
            $this->createTempFolder();
            $this->downloadFile();
            $this->extractContents();
        }
    }

    public function validateUpdate(){
        return true;
    }



    public function setDownloadUrl($var){
        $this->downloadUrl = $var;
    }

    public function getDownloadUrl(){
        return $this->downloadUrl;
    }

    private function getFileName(){
        $name = basename($this->getDownloadUrl()); // to get file name
        return $name;
    }

    private function getTarBasePath(){
        return $this->basePath
            . '/../'.self::TEMP_FOLDER;
    }

    private function getTarPath(){
        return $this->getTarBasePath().'/'
            . $this->getFileName();
    }

    private function downloadFile(){
        file_put_contents($this->getTarPath(), fopen($this->getDownloadUrl(), 'r'));
    }

    public function extractContents(){
        $command = "tar -xvf ". $this->getTarPath() . " -C ". $this->getExtractDestination();
        exec($command, $log);
    }

    private function getExtractDestination(){
        return $this->basePath . '/../'
            . self::TEMP_FOLDER.'/';
    }

    private function updatePath(){
        return $this->basePath . '/../';
    }

    private function updateSourcePath(){
        return $this->basePath . '/../'. self::TEMP_FOLDER .'/'
            . pathinfo($this->getFileName(), PATHINFO_FILENAME) . "/";
    }

    private function copyUpdatedFiles(){
        $params = $this->updateSourcePath() . " " . $this->updatePath();
        $fullCommand = $this->basePath . "/update.sh {$params}  > /dev/null 2> /dev/null &";
        exec($fullCommand);
    }


}
