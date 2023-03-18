<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_branch_bank';
//$client_name = $_REQUEST["client_type"];
//$client_name = $_REQUEST["client_name"];
$branch_code = $_REQUEST["branch_code"];

$Query = "select distinct(bank_name) from $tablename where branch_code='" . $branch_code . "' ";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["bank_name"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>