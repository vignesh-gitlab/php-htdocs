<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_tax_rate';
$return_page = 'tax_rate_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["tax_name"] . "','" . $_REQUEST["tax_rate"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set tax_name='" . $_REQUEST["tax_name"] . "',tax_rate='" . $_REQUEST["tax_rate"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>