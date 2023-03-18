<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_purchase_order';
//$client_name = $_REQUEST["client_name"];
//$division_name = $_REQUEST["division_name"];
$po_no = $_REQUEST["po_no"];

$Query = "select grand_total from $tablename where po_no='" . $po_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["grand_total"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>