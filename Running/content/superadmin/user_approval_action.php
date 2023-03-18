<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user_approval';
$return_page = 'user_creation_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query1 = "delete from $tablename where username='" . $_REQUEST["username"] . "'";
    $DB1->query($Query1);

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["usertype"] . "','" . $_REQUEST["username"] . "','" . $_REQUEST["po_approval_amount"] . "','" . $_REQUEST["fr_approval_amount"] . "','" . $_REQUEST["mr_approval_amount"] . "','" . $_REQUEST["pa_approval_amount"] . "','" . $_REQUEST["cr_approval_amount"] . "','" . $_REQUEST["pr_approval_amount"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set po_approval_amount='" . $_REQUEST["po_approval_amount"] . "',fr_approval_amount='" . $_REQUEST["fr_approval_amount"] . "',mr_approval_amount='" . $_REQUEST["mr_approval_amount"] . "',pa_approval_amount='" . $_REQUEST["pa_approval_amount"] . "',cr_approval_amount='" . $_REQUEST["cr_approval_amount"] . "',pr_approval_amount='" . $_REQUEST["pr_approval_amount"] . "' where username='" . $_REQUEST["username"] . "'";
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>