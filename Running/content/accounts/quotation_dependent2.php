<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lane';
$vehicle_type = $_REQUEST["vehicle_type"];

$Query = "select lane_id from $tablename where vehicle_type='" . $vehicle_type . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["lane_id"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>