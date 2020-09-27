<?php
class BackupCommand extends CConsoleCommand {

    private $basefilename = '';

    public function actionDb($name="", $tables = '*') {
        echo "started...";
        $filepath = $this->filePath($name);
        if ($tables == '*') {
            $tables = array();
            $tables = Yii::app()->db->schema->getTableNames();
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }
        $return = '';

        foreach ($tables as $table) {
            $result = Yii::app()->db->createCommand('SELECT * FROM ' . $table)->query();
            $return.= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = Yii::app()->db->createCommand('SHOW CREATE TABLE ' . $table)->queryRow();
            if(isset($row2['Create Table'])){
                $return.= "\n\n" . $row2['Create Table'] . ";\n\n";
            }
            foreach ($result as $row) {
                $return.= 'INSERT INTO ' . $table . ' VALUES(';
                foreach ($row as $data) {
                    $data = addslashes($data);

                    // Updated to preg_replace to suit PHP5.3 +
                    $data = preg_replace("/\n/", "\n", $data);
                    if (isset($data)) {
                        $return.= '"' . $data . '"';
                    } else {
                        $return.= '""';
                    }
                    $return.= ',';
                }
                $return = substr($return, 0, strlen($return) - 1);
                $return.= ");\n";
            }
            $return.="\n\n\n";
        }
        //save file
        $handle = fopen($filepath, 'w+');
        fwrite($handle, $return);
        fclose($handle);
        echo "completed...";
    }

    public function actionInit() {}


    private function filePath($name){
        if($name) {
            $fname = 'backup' . DIRECTORY_SEPARATOR  . $name . '.sql';
        }else{
            $fname = 'backup' . DIRECTORY_SEPARATOR. 'db_' . $this->cleanString(Yii::app()->name) . '_' . strtotime(date("D M d, Y G:i")).'.sql';
        }
        return Yii::app()->basePath.'/../'  . $fname;
    }


    private function cleanString($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}
?>