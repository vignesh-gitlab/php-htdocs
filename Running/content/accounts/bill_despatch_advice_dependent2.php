<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_branch_bank';
$branch_code = $_REQUEST["branch_code"];
$bank_name = $_REQUEST["bank_name"];

$Query = "select ac_no,bank_branch,account_balance from $tablename where branch_code='" . $branch_code . "' and bank_name='" . $bank_name . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["ac_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>