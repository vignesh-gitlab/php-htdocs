<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_frieght_bill_item';
$bill_no = $_REQUEST["bill_no"];

$Query = "select bill_date_item,pending_amount from $tablename where no_item='" . $bill_no . "' and pending_amount>0";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["bill_date_item"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["pending_amount"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>