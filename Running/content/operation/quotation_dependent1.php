<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_client';
//$client_name = $_REQUEST["client_type"];
$client_type = trim($_REQUEST["client_type"]);
$client_type_split = explode(':', $client_type);
$client_name = trim($client_type_split[0]);
$division_name = trim($client_type_split[1]);
$branch_name = trim($client_type_split[2]);
//$machine_code = $_REQUEST["machine_code"];

$Query = "select client_name,division_name,branch_name,address_line1,address_line2,city,pincode,mobile_no from $tablename where client_name='" . $client_name . "' and division_name='" . $division_name . "' and branch_name='" . $branch_name . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["client_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["division_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["branch_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line1"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line2"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["pincode"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["mobile_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>