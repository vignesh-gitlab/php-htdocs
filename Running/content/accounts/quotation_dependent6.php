<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contract_item';
$charge_base = $_REQUEST["charge_base"];

$Query = "select lane_id from $tablename where charge_base='" . $charge_base . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["lane_id"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>