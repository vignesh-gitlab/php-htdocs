<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_customer_order';
//$client_name = $_REQUEST["client_name"];
//$division_name = $_REQUEST["division_name"];
$so_no = $_REQUEST["so_no"];

$Query = "select order_no,client_name,division_name,branch_name from $tablename where so_no='" . $so_no . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["order_no"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["client_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["division_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["branch_name"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>