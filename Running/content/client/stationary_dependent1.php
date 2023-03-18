<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_company';

$Query = "select city from $tablename where branch_code='" . $_REQUEST["branch_code"] . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["city"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>