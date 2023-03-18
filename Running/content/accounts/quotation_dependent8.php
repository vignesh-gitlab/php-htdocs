<?php

include'../../template/common/header.default_action.php';

$tablename = 'sr_contract_item';
$client_name = $_REQUEST["client_name"];
$type_of_movement = $_REQUEST["type_of_movement"];
$charge_base = $_REQUEST["charge_base"];
$lane_id = $_REQUEST["lane_id"];
$line_total = $_REQUEST["line_total"];

$Query = "select contract_no from sr_contract where customer_name='" . $client_name . "' and status='Open'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $contract_no = $DB->Record["contract_no"];
}

$Query = "select charges from $tablename where contract_no='" . $contract_no . "' and type_of_movement='" . $type_of_movement . "' and charge_base='" . $charge_base . "' and lane_id='" . $lane_id . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    if (strtolower($line_total) != strtolower($DB->Record["charges"]))
        $str = $str . "\"" . "Fill Remarks" . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>