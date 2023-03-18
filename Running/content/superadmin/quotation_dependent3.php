<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contract_item';
$lane_id = $_REQUEST["lane_id"];
$type_of_movement = $_REQUEST["type_of_movement"];
$charge_base = $_REQUEST["charge_base"];

$Query = "select departure,arrival,charges from $tablename where lane_id='" . $lane_id . "' and type_of_movement='" . $type_of_movement . "' and charge_base='" . $charge_base . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["departure"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["arrival"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["charges"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>