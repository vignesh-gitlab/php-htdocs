<?php

include'../../template/common/header.default_action.php';

$client_location = $_REQUEST["client_location"];

if ($client_location == "Client") {
    $Query = "select distinct(client_name) from sr_client order by client_name";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["client_name"] . "\"" . ",";
    }
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>