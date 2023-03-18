<?php

include'../../template/common/header.default_action.php';

$tablename = 'sr_quotation_item';
$quotation_ref_no = $_REQUEST["quotation_ref_no"];
$lane_id = $_REQUEST["lane_id"];
$line_total = $_REQUEST["line_total"];

$Query = "select unit_price from $tablename where quotation_no='" . $quotation_ref_no . "' and lane_id='" . $lane_id . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    if (strtolower($line_total) != strtolower($UDB->Record["unit_price"]))
        $str = $str . "\"" . "Fill Remarks" . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>