<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_company';
/* $contract_period = trim($_REQUEST["contract_period"]);
  $contract_period_split = explode(':', $contract_period);
  $warranty_from = trim($contract_period_split[0]);
  $warranty_to = trim($contract_period_split[1]); */
$branch_code = $_REQUEST["branch_code"];

$Query = "select branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,fax_no,email_id,website_id,tin_no,cst_no from $tablename where branch_code='" . $branch_code . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    //$str = $str . "\"" . $DB->Record["company_name"] . "-" . $DB->Record["city"] . "\"" . ",";
    /* $str = $str . "\"" . $DB->Record["company_caption"] . "\"" . ",";
      $str = $str . "\"" . $DB->Record["address_line1"] . "\"" . ",";
      $str = $str . "\"" . $DB->Record["address_line2"] . "\"" . ","; */
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>