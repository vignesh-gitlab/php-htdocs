<?php

include'../../template/common/header.default_action.php';
$tablename = 'master_tax_name';
$return_page = 'tax_name_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["tax_name"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set tax_name='" . $_REQUEST["tax_name"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>