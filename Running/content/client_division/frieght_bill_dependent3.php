<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_bilty';
$stationary_no = $_REQUEST["no_item"];

$Query = "select lane_from,lane_to from $tablename where stationary_no='" . $stationary_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["lane_from"] . '-' . $UDB->Record["lane_to"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>