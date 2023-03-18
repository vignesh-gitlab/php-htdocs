<?php

include'../../template/common/header.default_action.php';
$tablename = 'master_user_approval_amount';
$return_page = 'user_approval_amount_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["user_approval_amount"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set user_approval_amount='" . $_REQUEST["user_approval_amount"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>