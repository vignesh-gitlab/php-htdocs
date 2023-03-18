<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_payment_advice';
$tablename1 = 'sr_payment_advice_item';
$return_page = 'payment_advice_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["company_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["client_city"] . "','" . $_REQUEST["client_pincode"] . "','" . $_REQUEST["document_no"] . "','" . $_REQUEST["document_date"] . "','" . $_REQUEST["cheque_no"] . "','" . $_REQUEST["cheque_date"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["cheque_amount"] . "','" . $_REQUEST["pan_no"] . "','" . $_REQUEST["tds_status"] . "','" . $_REQUEST["total_tds"] . "','" . $_REQUEST["total"] . "','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ((isset($_REQUEST["lr_no" . $i]) && !empty($_REQUEST["lr_no" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["document_no"] . "','" . $_REQUEST["lr_no" . $i] . "','" . $_REQUEST["challan_no" . $i] . "','" . $_REQUEST["lr_date" . $i] . "','" . $_REQUEST["un_ld_date" . $i] . "','" . $_REQUEST["bal_amt" . $i] . "','" . $_REQUEST["hamali_paid" . $i] . "','" . $_REQUEST["hamali_collect" . $i] . "','" . $_REQUEST["tds_amt" . $i] . "','" . $_REQUEST["claim_amt" . $i] . "','" . $_REQUEST["late_delivery" . $i] . "','" . $_REQUEST["destination" . $i] . "','" . $_REQUEST["line_total" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set pa_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set order_no='" . $_REQUEST["order_no"] . "', client_name='" . $_REQUEST["client_name"] . "',company_name='" . $_REQUEST["company_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',client_city='" . $_REQUEST["client_city"] . "',client_pincode='" . $_REQUEST["client_pincode"] . "',document_no='" . $_REQUEST["document_no"] . "',document_date='" . $_REQUEST["document_date"] . "',cheque_no='" . $_REQUEST["cheque_no"] . "',cheque_date='" . $_REQUEST["cheque_date"] . "',branch_code='" . $_REQUEST["branch_code"] . "',bank_name='" . $_REQUEST["bank_name"] . "',cheque_amount='" . $_REQUEST["cheque_amount"] . "',pan_no='" . $_REQUEST["pan_no"] . "',tds_status='" . $_REQUEST["tds_status"] . "',total_tds='" . $_REQUEST["total_tds"] . "',total='" . $_REQUEST["total"] . "',pan_no='" . $_REQUEST["pan_no"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ((isset($_REQUEST["lr_no" . $i]) && !empty($_REQUEST["lr_no" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["document_no"] . "','" . $_REQUEST["lr_no" . $i] . "','" . $_REQUEST["challan_no" . $i] . "','" . $_REQUEST["lr_date" . $i] . "','" . $_REQUEST["un_ld_date" . $i] . "','" . $_REQUEST["bal_amt" . $i] . "','" . $_REQUEST["hamali_paid" . $i] . "','" . $_REQUEST["hamali_collect" . $i] . "','" . $_REQUEST["tds_amt" . $i] . "','" . $_REQUEST["claim_amt" . $i] . "','" . $_REQUEST["late_delivery" . $i] . "','" . $_REQUEST["destination" . $i] . "','" . $_REQUEST["line_total" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where document_no='" . $_REQUEST["document_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["document_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>