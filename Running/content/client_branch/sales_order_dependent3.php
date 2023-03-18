<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_client';
$client_name = $_REQUEST["client_name"];
$division_name = $_REQUEST["division_name"];
$branch_name = $_REQUEST["branch_name"];

$Query = "select address_line1,address_line2,city,pincode,mobile_no from $tablename where client_name='" . $client_name . "' and division_name='" . $division_name . "' and branch_name='" . $branch_name . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["address_line1"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["address_line2"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["pincode"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["mobile_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>