<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_stationary';

$con_no = $_REQUEST["con_no"];
$Query = "SELECT order_no from sr_bilty where consignment_note_no='" . $con_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $order_no = $UDB->Record["order_no"];
}

$Query = "SELECT description from sr_bilty_item where order_no='" . $order_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["description"] . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>