<?php


class PDMUpdater
{

    private $downloadUrl;
    private $basePath;
    const TEMP_FOLDER = "temp";
    private $error;
    const UPDATE_URL = "https://app.wftutorials.com/api/updates";
    const TEST_UPDATE_URL = "http://dev.codebook.com/api/updates";
    public $response;

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
        return $this->downloadFile();
    }

    public function getErrorMessage(){
        return $this->error;
    }

    public function update(){
        if(!$this->downloadUrl){

        }else{
            $this->createTempFolder();
            $this->downloadFile();
            $this->extractContents();
        }
    }

    public function cleanUp(){
        $tempPath = $this->getTarBasePath() . "/*";
        exec("rm -rf ".$tempPath, $log);
    }

    public function validateUpdate(){
        $valid = true;
        $url = $this->getDownloadUrl();
        if (filter_var($url, FILTER_VALIDATE_URL) == false){
            $valid = false;
            $this->error = "Url is not valid (" . $url . ")";
            return false;
        }else{
            $filename = $this->getFileName();
            $file_parts = pathinfo($filename);
            $info = parse_url($url);
            if($info["host"] != "wfspace.sfo2.digitaloceanspaces.com"){
                $valid = false;
                $this->error = "Not a valid update path (".$info["host"]. ")";
            }
            if(isset($file_parts['extension']) &&  $file_parts['extension']!= "gz"){
                $valid = false;
                $this->error = "File is not tar. (". $filename.")";
            }
        }

        return $valid;
    }



    public function setDownloadUrl($var){
        $this->downloadUrl = $var;
    }

    public function getDownloadUrl(){
        return trim($this->downloadUrl);
    }

    private function getFileName(){
        $name = basename($this->getDownloadUrl()); // to get file name
        return $name;
    }

    private function getTwoDotsAndASlash(){
        return DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
    }

    private function getTarBasePath(){
        return $this->basePath
            . $this->getTwoDotsAndASlash() .self::TEMP_FOLDER;
    }

    private function getTarPath(){
        return $this->getTarBasePath(). DIRECTORY_SEPARATOR
            . $this->getFileName();
    }

    private function downloadFile(){
        file_put_contents($this->getTarPath(), fopen($this->getDownloadUrl(), 'r') );
        return true;
    }

    public function extractContents(){
        $command = "tar -xzvf ". $this->getTarPath() . " -C ". $this->getExtractDestination();
        return shell_exec($command);
    }

    private function getExtractDestination(){
        return $this->basePath . $this->getTwoDotsAndASlash()
            . self::TEMP_FOLDER. DIRECTORY_SEPARATOR;
    }

    private function updatePath(){
        return $this->basePath . $this->getTwoDotsAndASlash();
    }

    private function updateSourcePath(){
        return $this->basePath . $this->getTwoDotsAndASlash(). self::TEMP_FOLDER . DIRECTORY_SEPARATOR
            . pathinfo(pathinfo($this->getFileName(), PATHINFO_FILENAME), PATHINFO_FILENAME) . DIRECTORY_SEPARATOR;
    }

    public function copyUpdatedFiles(){
        $params = $this->updateSourcePath() . " " . $this->updatePath();
        //$fullCommand = $this->basePath . "/update.sh {$params}";
        return shell_exec("rsync -a " . $params);
    }

    public function getUpdateUrl(){
        if(YII_DEBUG){
            return self::TEST_UPDATE_URL;
        }else{
            return self::UPDATE_URL;
        }
    }

    public function getUpdates(){
        $url = $this->getUpdateUrl();
        $res = file_get_contents($url);
        $this->response = $res;
        return $res;
    }

    public function updateAppVersion($ver){
        Utils::setAppVersion($ver);
    }

    /**
    public function getUpdates(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getUpdateUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $this->response = $response;
        $err = curl_error($curl);

        curl_close($curl);
        if($err){
            $this->error = $err;
            return false;
        }else{
            return true;
        }
    }**/


}
