<?php

include'../../template/common/header.default_action.php';
$tablename = 'master_service_tax_payable_by';
$return_page = 'service_tax_payable_by_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["service_tax_payable_by"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set service_tax_payable_by='" . $_REQUEST["service_tax_payable_by"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>