<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contract_item';
$client_name = $_REQUEST["client_name"];

$Query = "select contract_no from sr_contract where customer_name='" . $client_name . "' and status='Open'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $contract_no = $DB->Record["contract_no"];
}

$Query = "select type_of_movement from $tablename where contract_no='" . $contract_no . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["type_of_movement"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>