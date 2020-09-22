<?php


class UpdateAction extends CAction
{

    public function run(){
        $steps = $_GET["steps"];
        $url =  Utils::getPost('url');
        $updateVersion = Utils::getPost('version');
        if(!$url){
            echo Utils::jsonResponse(Utils::STATUS_BAD,'URL not valid...');
        }else if(!$updateVersion){
            echo Utils::jsonResponse(Utils::STATUS_BAD,'No version provided...');
        }else{
            $updater = new PDMUpdater($url);
            if($steps == "validate"){
                if($updater->validateUpdate()){
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,'Valid url...');
                }else{
                    echo Utils::jsonResponse(Utils::STATUS_BAD,$updater->getErrorMessage()."...");
                }
            }else if($steps == "download"){
                $updater->createTempFolder();
                if($updater->downloadUpdatePackage()){
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,'Package downloaded...');
                }else{
                    echo Utils::jsonResponse(Utils::STATUS_BAD,$updater->getErrorMessage());
                }
            }else if($steps == "extract"){
                $log = $updater->extractContents();
                if($log){
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,"Contents extracted");
                }else{
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,$log);
                }
            }else if($steps == "transfer"){
                if(!YII_DEBUG){
                    $msg = $updater->copyUpdatedFiles();
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,$msg);
                }else{
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,'New updates copied(TEST)....');
                }
            }else if($steps == "tables"){
                $form = new SetupForm();
                if($form->update_tables()){
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,'Tables updated with no errors...');
                }else{
                    echo Utils::jsonResponse(Utils::STATUS_GOOD,$form->errorMessage . "\r\n Continuing...");
                }
            }else if($steps == "cleanup"){
                $updater->updateAppVersion($updateVersion);
                $updater->cleanUp();
                echo Utils::jsonResponse(Utils::STATUS_GOOD,'Clean up completed...');
            }
        }
    }
}
