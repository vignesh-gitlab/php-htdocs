<?php

include'../../template/common/header.default_action.php';

$tablename = 'sr_lane';
$lane_id = $_REQUEST["lane_id"];

$Query = "select lane_id from $tablename";
$DB->query($Query);
while ($DB->Multicoloums()) {
    if (strtolower($lane_id) == strtolower($DB->Record["lane_id"]))
        $str = $str . "\"" . "Lane ID Already Exists" . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>