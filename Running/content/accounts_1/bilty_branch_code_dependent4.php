<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_stationary';

$branch_code = $_REQUEST["branch_code"];
$Query = "SELECT distinct(consignment_note_no) from sr_bilty where branch_code='" . $branch_code . "' and bilty_status='Not Yet Released' order by consignment_note_no";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $str = $str . "\"" . $UDB->Record["consignment_note_no"] . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>