<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user';
$usertype = $_REQUEST["usertype"];

$Query = "select distinct(username) from $tablename where usertype='" . $usertype . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["username"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>