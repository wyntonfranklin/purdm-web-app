<?php
Yii::import('application.extensions.*');
require_once('phpexcel/JPhpExcel.php');
require_once('phpexcelreader/JPhpExcelReader.php');

class ExcelAdapter
{

  public function createExcel($data, $filename){
    $xls = new JPhpExcel('UTF-8', false, 'All Transactions');
    $xls->addArray($data);
    $xls->generateXML($filename);
  }

  public function getRows($path){
    $data=new JPhpExcelReader($path);
    return $data;
  }

  public function assignTransactionsCols($cols){
    return array(
      "transDate" => isset($cols[1]) ? $cols[1] : "",
      "amount" => isset($cols[2]) ? $cols[2] : "",
      "description" => isset($cols[3]) ? $cols[3] : "",
      "category" => isset($cols[4]) ? $cols[4] : "",
      "account" => isset($cols[5]) ? $cols[5] : "",
      "type" => isset($cols[6]) ? $cols[6] : "",
      "memo" => isset($cols[7]) ? $cols[7] : "",
    );
  }

}

?>
