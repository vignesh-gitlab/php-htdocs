<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_advance_cash_receipt';
$return_page = 'advance_cash_receipt_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "SELECT max(cast(receipt_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_advance_receipt_no_prefix . $new_max_id;
    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["receipt_date"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["received_from"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["amount"] . "','" . $_REQUEST["payment_mode"] . "','" . $_REQUEST["payment_description"] . "')";
    $UDB->query($Query);

    $Query = "update sr_client set advance_amount='" . $_REQUEST["amount"] . "' where client_name='" . $_REQUEST["client_name"] . "' and division_name='" . $_REQUEST["division_name"] . "' and branch_name='" . $_REQUEST["branch_name"] . "'";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set receipt_date='" . $_REQUEST["receipt_date"] . "',client_name='" . $_REQUEST["client_name"] . "',division_name='" . $_REQUEST["division_name"] . "',branch_name='" . $_REQUEST["branch_name"] . "',received_from='" . $_REQUEST["received_from"] . "',description='" . $_REQUEST["description"] . "',amount='" . $_REQUEST["amount"] . "',mode_of_payment='" . $_REQUEST["payment_mode"] . "',payment_description='" . $_REQUEST["payment_description"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query1 = "update sr_client set advance_amount='" . $_REQUEST["amount"] . "' where client_name='" . $_REQUEST["client_name"] . "' and division_name='" . $_REQUEST["division_name"] . "' and branch_name='" . $_REQUEST["branch_name"] . "'";
    $DB->query($Query1);
}
$FN->page_redirect($return_page);
?>