<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contract_item';
$type_of_movement = $_REQUEST["type_of_movement"];

$Query = "select charge_base from $tablename where type_of_movement='" . $type_of_movement . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["charge_base"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>