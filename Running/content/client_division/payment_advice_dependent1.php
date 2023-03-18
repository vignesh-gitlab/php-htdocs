<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_tax_rate';
$tds_status = $_REQUEST["tds_status"];

if ($tds_status == "Applicable") {
    $Query = "select tax_rate from $tablename where tax_name='TDS'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["tax_rate"] . "\"" . ",";
    }
} else {
    $Query = "select tax_rate from $tablename where tax_name='TDS'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\" 0 \"" . ",";
    }
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>