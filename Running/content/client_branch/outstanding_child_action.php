<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_payments';
$return_page = 'frieght_bill_approval_grid.php';
//$return_page = 'outstanding_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Update") {

    $Query = "insert into $tablename values('NULL','" . $_REQUEST["invoice_type"] . "','" . $_REQUEST["invoice_no"] . "','" . $_REQUEST["payment_date"] . "','" . $_REQUEST["amount_paid"] . "','" . $_REQUEST["payment_mode"] . "','" . $_REQUEST["payment_description"] . "','" . $_REQUEST["received_from"] . "','" . $_REQUEST["received_by"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "')";
    $UDB->query($Query);

    $exist_amount_received = $_REQUEST["amount_received"];
    $exist_pending_amount = $_REQUEST["pending_amount"];
    $amount_paid = $_REQUEST["amount_paid"];

    $amount_received = $exist_amount_received + $amount_paid;
    $pending_amount = $exist_pending_amount - $amount_paid;

    if ($_REQUEST["invoice_type"] == "Frieght") {
        $Query1 = "update sr_frieght_bill set total_amount_received='" . $amount_received . "',total_pending_amount='" . $pending_amount . "' where bill_no='" . $_REQUEST["invoice_no"] . "'";

        if ($pending_amount == 0) {
            $Query = "update sr_frieght_bill set frieght_status='Close' where bill_no='" . $_REQUEST["invoice_no"] . "'";
            $UDB->query($Query);
        }
    } else if ($_REQUEST["invoice_type"] == "Service") {
        $Query1 = "update sr_service_invoice set amount_received='" . $amount_received . "',pending_amount='" . $pending_amount . "' where si_number='" . $_REQUEST["invoice_no"] . "'";

        if ($pending_amount == 0) {
            $Query = "update sr_service_invoice set si_status='Close' where si_number='" . $_REQUEST["invoice_no"] . "'";
            $UDB->query($Query);
        }
    } else if ($_REQUEST["invoice_type"] == "AMC") {
        $Query1 = "update sr_amc set amount_received='" . $amount_received . "',pending_amount='" . $pending_amount . "' where amc_no='" . $_REQUEST["invoice_no"] . "'";
    }
    $UDB->query($Query1);
}
$FN->page_redirect($return_page);
?>