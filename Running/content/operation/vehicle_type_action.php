<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_type';
$return_page = 'vehicle_type_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["vehicle_type"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set vehicle_type='" . $_REQUEST["vehicle_type"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>