<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_stationary';

$code = $_REQUEST["code"];
$con_no = $_REQUEST["con_no"];

$Query = "SELECT order_no from sr_bilty where consignment_note_no='" . $code . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $order_no = $UDB->Record["order_no"];
}



$Query = "SELECT description,packages_unit,packages,weight_actual from sr_bilty_item where order_no='" . $order_no . "' and description='" . $con_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["description"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["packages_unit"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["packages"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["weight_actual"] . "\"" . ",";
}

$Query = "SELECT lane_to from sr_bilty where order_no='" . $order_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["lane_to"] . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>