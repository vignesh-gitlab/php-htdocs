<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_money_receipt';
$tablename1 = 'sr_money_receipt_item';
$return_page = 'money_receipt_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["branch"] . "','" . $_REQUEST["bmr_no"] . "','" . $_REQUEST["bmr_date"] . "','" . $_REQUEST["ac_code"] . "','" . $_REQUEST["cheque_no"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["mr_date"] . "','" . $_REQUEST["bill_frt_total"] . "','" . $_REQUEST["bill_oct_total"] . "','" . $_REQUEST["received_frt_total"] . "','" . $_REQUEST["received_oct_total"] . "','" . $_REQUEST["rem_total"] . "','" . $_REQUEST["tds_amount"] . "','" . $_REQUEST["claim_amount"] . "','" . $_REQUEST["excess_billing"] . "','" . $_REQUEST["hamali"] . "','" . $_REQUEST["advance"] . "','" . $_REQUEST["against_referrence"] . "','" . $_REQUEST["others"] . "','" . $_REQUEST["non_account"] . "','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ((isset($_REQUEST["bill_no" . $i]) && !empty($_REQUEST["bill_no" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["bill_no" . $i] . "','" . $_REQUEST["bill_date" . $i] . "','" . $_REQUEST["bill_frt" . $i] . "','" . $_REQUEST["bill_oct" . $i] . "','" . $_REQUEST["received_frt" . $i] . "','" . $_REQUEST["received_oct" . $i] . "','" . $_REQUEST["rem" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set mr_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set order_no='" . $_REQUEST["order_no"] . "',so_no='" . $_REQUEST["so_no"] . "', client_name='" . $_REQUEST["client_name"] . "',branch='" . $_REQUEST["branch"] . "',bmr_no='" . $_REQUEST["bmr_no"] . "',bmr_date='" . $_REQUEST["bmr_date"] . "',ac_code='" . $_REQUEST["ac_code"] . "',cheque_no='" . $_REQUEST["cheque_no"] . "',bank_name='" . $_REQUEST["bank_name"] . "',mr_date='" . $_REQUEST["mr_date"] . "',bill_frt_total='" . $_REQUEST["bill_frt_total"] . "',bill_oct_total='" . $_REQUEST["bill_oct_total"] . "',received_frt_total='" . $_REQUEST["received_frt_total"] . "',received_oct_total='" . $_REQUEST["received_oct_total"] . "',rem_total='" . $_REQUEST["rem_total"] . "',tds_amount='" . $_REQUEST["tds_amount"] . "',claim_amount='" . $_REQUEST["claim_amount"] . "',excess_billing='" . $_REQUEST["excess_billing"] . "',hamali='" . $_REQUEST["hamali"] . "',advance='" . $_REQUEST["advance"] . "',against_referrence='" . $_REQUEST["against_referrence"] . "',others='" . $_REQUEST["others"] . "',non_account='" . $_REQUEST["non_account"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ((isset($_REQUEST["bill_no" . $i]) && !empty($_REQUEST["bill_no" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["bill_no" . $i] . "','" . $_REQUEST["bill_date" . $i] . "','" . $_REQUEST["bill_frt" . $i] . "','" . $_REQUEST["bill_oct" . $i] . "','" . $_REQUEST["received_frt" . $i] . "','" . $_REQUEST["received_oct" . $i] . "','" . $_REQUEST["rem" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>