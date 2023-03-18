<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_client';
$tablename1 = 'sr_vendor';
if ($_REQUEST["lane_category"] == "Client") {
    $Query = "select client_name,division_name,branch_name from $tablename";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["client_name"] . "\"" . ",";
    }
} else if ($_REQUEST["lane_category"] == "Vendor") {
    $Query = "select vendor_name from $tablename1";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["vendor_name"] . "\"" . ",";
    }
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>