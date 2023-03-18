<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lane';
$customer_name = $_REQUEST["customer_name"];

$Query = "select lane_id from $tablename where lane_category_name='" . $customer_name . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["lane_id"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>