<?php

include'../../template/common/header.default_action.php';
$tablename = 'master_ownership';
$return_page = 'vehicle_ownership_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["ownership"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set ownership='" . $_REQUEST["ownership"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>