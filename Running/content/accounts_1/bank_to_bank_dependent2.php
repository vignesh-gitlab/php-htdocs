<?php

include'../../template/common/header.default_action.php';
$payment_no = $_REQUEST["payment_no"];

$Query = "select branch_code,branch_name,amount,payment_description from sr_payment_request where payment_no='" . $payment_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $branch_code = $UDB->Record["branch_code"];
    $str = $str . "\"" . $UDB->Record["branch_code"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["branch_name"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["amount"] . "\"" . ",";
    $str = $str . "\"" . $UDB->Record["payment_description"] . "\"" . ",";
}

$Query = "select bank_name,bank_branch,ac_no,ac_name,ac_type,ifsc_code,minimum_balance,account_balance from sr_branch_bank where branch_code='" . $branch_code . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["bank_name"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["bank_branch"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["ac_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>