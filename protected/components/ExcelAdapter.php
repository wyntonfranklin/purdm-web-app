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

  public function shipperColumns($cols){
    return array(
      "company_name" => $cols[0],
      "company_address" => $cols[1],
      "company_telephone" => $cols[2],
      "contact_person" => $cols[3],
      "contact_email" => $cols[4],
      "contact_telephone" => $cols[5],
    );
  }

  public function preferenceColumns($cols){
    return array(
      "country_group" => $cols[0],
      "country_name" => $cols[1],
      "air" => $cols[2],
      "sea" => $cols[3],
      "direct" => $cols[4],
      "trans_ship" => $cols[5],
      "fcl" => $cols[6],
      "lcl" => $cols[7],
      "reffer" => $cols[8],
      "transit" => $cols[9],
      "frequency" => $cols[10],
      "restrict" => $cols[11],
      "soc" => $cols[12],
    );
  }

}

?>
