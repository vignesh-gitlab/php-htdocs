<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lane';
$lane_id = $_REQUEST["lane_id"];

$Query = "select lane_from,lane_to,rate from $tablename where lane_id='" . $lane_id . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["lane_from"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["lane_to"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["rate"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>