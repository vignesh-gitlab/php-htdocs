<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_company';
$zonal_code = $_REQUEST["zonal_code"];

$Query = "select company_name from $tablename where zonal_code='" . $zonal_code . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["company_name"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>