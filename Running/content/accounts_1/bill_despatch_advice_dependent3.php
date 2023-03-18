<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_frieght_bill';
$bill_no = $_REQUEST["bill_no"];
$bank_name = $_REQUEST["bank_name"];

$Query = "select bill_date,total from $tablename where bill_no='" . $_REQUEST["bill_no"] . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["bill_date"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["total"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>