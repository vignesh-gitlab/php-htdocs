<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user';

$Query = "select distinct(branch_name) from sr_client where division_name='" . $_REQUEST["division"] . "' order by branch_name";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["branch_name"] . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>