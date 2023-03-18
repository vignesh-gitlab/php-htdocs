<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_bilty';
$client_name = $_REQUEST["client_name"];
$branch_code = $_REQUEST["branch_code"];

$Query = "select stationary_no from $tablename where to_be_billed_at='" . $branch_code . "' and consignor_name='" . $client_name . "' and bilty_status<>'Released'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["stationary_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>