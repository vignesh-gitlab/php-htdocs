<?php

include'../../template/common/header.default_action.php';

$client_location = $_REQUEST["client_location"];

if ($client_location == "Branch") {
    $Query = "select distinct(branch_name) from sr_client where company_type='Branch' order by branch_name";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["branch_name"] . "\"" . ",";
    }
} else if ($client_location == "Sea Port") {
    $Query = "select distinct(port_name) from master_ports where port_type='Sea Port' order by port_name";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["port_name"] . "\"" . ",";
    }
} else if ($client_location == "Air Port") {
    $Query = "select distinct(port_name) from master_ports where port_type='Air Port' order by port_name";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $str = $str . "\"" . $DB->Record["port_name"] . "\"" . ",";
    }
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>