<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contractor';
//$client_name = $_REQUEST["client_type"];
$contractor_type = trim($_REQUEST["contractor_type"]);
$contractor_type_split = explode(':', $contractor_type);
$contractor_name = trim($contractor_type_split[0]);
$city = trim($contractor_type_split[1]);
//$machine_code = $_REQUEST["machine_code"];

$Query = "select contractor_name,address_line1,address_line2,city,pincode,mobile_no from $tablename where contractor_name='" . $contractor_name . "' and city='" . $city . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["contractor_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line1"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line2"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["pincode"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["mobile_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>