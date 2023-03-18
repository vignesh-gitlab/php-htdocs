<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_client';
//$client_name = $_REQUEST["client_type"];
$client_name = $_REQUEST["client_name"];

$Query = "select distinct(division_name) from $tablename where client_name='" . $client_name . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["division_name"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>