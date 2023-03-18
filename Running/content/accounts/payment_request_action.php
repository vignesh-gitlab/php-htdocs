<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_payment_request';
$return_page = 'payment_request_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "SELECT max(cast(payment_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_payment_no_prefix . $new_max_id;
    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["order_no"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["po_number"] . "','" . $_REQUEST["po_amount"] . "','" . $_REQUEST["payment_type"] . "','" . $_REQUEST["amount"] . "','" . $_REQUEST["payment_description"] . "','Open')";
    $UDB->query($Query);
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set pr_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set order_no='" . $_REQUEST["order_no"] . "', branch_code='" . $_REQUEST["branch_code"] . "',branch_name='" . $_REQUEST["branch_name"] . "',description='" . $_REQUEST["description"] . "',po_number='" . $_REQUEST["po_number"] . "',po_amount='" . $_REQUEST["po_amount"] . "',payment_type='" . $_REQUEST["payment_type"] . "',amount='" . $_REQUEST["amount"] . "',payment_description='" . $_REQUEST["payment_description"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where payment_no='" . $_REQUEST["payment_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>