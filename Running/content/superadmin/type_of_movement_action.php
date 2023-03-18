<?php

include'../../template/common/header.default_action.php';
$tablename = 'master_type_of_movement';
$return_page = 'type_of_movement_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["type_of_movement"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set type_of_movement='" . $_REQUEST["type_of_movement"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>