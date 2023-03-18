<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vendor';
//$client_name = $_REQUEST["client_type"];
//$client_name = $_REQUEST["client_name"];
$vendor_name = $_REQUEST["vendor_name"];

$Query = "select vendor_name,address_line1,address_line2,city,pincode from $tablename where vendor_name='" . $vendor_name . "' ";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["vendor_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line1"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line2"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["pincode"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>