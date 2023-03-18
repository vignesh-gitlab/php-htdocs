<?php

include'../../template/common/header.default_action.php';

$hello = "Hello";

$Query = "select term_value from master_terms_condition where term_name='" . trim($_REQUEST["terms_list"]) . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["term_value"] . "\"" . ",";
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>