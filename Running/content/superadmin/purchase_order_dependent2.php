<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vendor';
//$client_name = $_REQUEST["client_type"];
$vendor_type = trim($_REQUEST["contractor_type"]);
$vendor_type_split = explode(':', $vendor_type);
$vendor_name = trim($vendor_type_split[0]);
$city = trim($vendor_type_split[1]);
//$machine_code = $_REQUEST["machine_code"];

$Query = "select vendor_name,address_line1,address_line2,city,pincode,mobile_no from $tablename where vendor_name='" . $vendor_name . "' and city='" . $city . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["vendor_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line1"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line2"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["pincode"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["mobile_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>