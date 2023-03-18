<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lane';
$lane_id = $_REQUEST["lane_id"];
$customer_name = $_REQUEST["customer_name"];

$Query = "select lane_from,lane_to,vehicle_type,duration from $tablename where lane_category_name='" . $customer_name . "' and lane_id='" . $lane_id . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["lane_from"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["lane_to"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["vehicle_type"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["duration"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>