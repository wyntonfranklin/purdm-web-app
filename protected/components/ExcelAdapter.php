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

  public function assignColumns($cols){
    return array(
      "name" => $cols[0],
      "firstname" => $cols[2],
      "lastname" => $cols[3],
      "company" => $cols[3],
      "office" => $cols[8],
      "mobile" => $cols[7],
      "email" => $cols[1],
      "sector" => $cols[6],
      "regdate" => $cols[14],
			"registration_number" => "",
      "work_street" => $cols[10],
      "work_city" => $cols[11],
      "country" => $cols[12],
      "profession" => $cols[5],
      "current_employer" => $cols[4],
      "company_website" => $cols[9],
      "work_postal_code" => "",
      "work_landline" => $cols[8],
      "work_mobile" => "",
      "last_access" => $cols[13],
      "member_for" => $cols[14]
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
