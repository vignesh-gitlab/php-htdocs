<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user';

$Query = "select distinct(division_name) from sr_client where client_name='" . $_REQUEST["display_name"] . "' order by division_name";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["division_name"] . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>