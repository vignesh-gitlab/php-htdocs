<?php

include'../../template/common/header.default_action.php';
$tablename = 'master_ports';
$return_page = 'port_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["port_type"] . "','" . $_REQUEST["port_name"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set port_type='" . $_REQUEST["port_type"] . "',port_name='" . $_REQUEST["port_name"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>