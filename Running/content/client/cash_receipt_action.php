<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_cash_receipt';
$tablename1 = 'sr_cash_receipt_item';
$return_page = 'cash_receipt_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["company_name"] . "','" . $_REQUEST["regd_no"] . "','" . $_REQUEST["telephone"] . "','" . $_REQUEST["tali_no"] . "','" . $_REQUEST["table_no"] . "','" . $_REQUEST["period_from"] . "','" . $_REQUEST["period_to"] . "','" . $_REQUEST["total_wages_rs"] . "','" . $_REQUEST["total_wages_ps"] . "','" . $_REQUEST["total_lavy_rs"] . "','" . $_REQUEST["total_lavy_ps"] . "','" . $_REQUEST["total_rs"] . "','" . $_REQUEST["total_ps"] . "','" . $_REQUEST["total_wages"] . "','" . $_REQUEST["total_levy"] . "','" . $_REQUEST["total_others"] . "','" . $_REQUEST["total"] . "','" . $_REQUEST["cheque_no"] . "','" . $_REQUEST["cheque_date"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["payment_mode"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["vehicle_date"] . "','" . $_REQUEST["frieght_advance"] . "','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {

        if ((isset($_REQUEST["wages_rs" . $i]) && !empty($_REQUEST["wages_rs" . $i]))) {

            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["receipt_date" . $i] . "','" . $_REQUEST["wages_rs" . $i] . "','" . $_REQUEST["wages_ps" . $i] . "','" . $_REQUEST["lavy_rs" . $i] . "','" . $_REQUEST["lavy_ps" . $i] . "','" . $_REQUEST["line_total_rs" . $i] . "','" . $_REQUEST["line_total_ps" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set cr_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set order_no='" . $_REQUEST["order_no"] . "', company_name='" . $_REQUEST["company_name"] . "',regd_no='" . $_REQUEST["regd_no"] . "',telephone='" . $_REQUEST["telephone"] . "',tali_no='" . $_REQUEST["tali_no"] . "',table_no='" . $_REQUEST["table_no"] . "',period_from='" . $_REQUEST["period_from"] . "',period_to='" . $_REQUEST["period_to"] . "',total_wages_rs='" . $_REQUEST["total_wages_rs"] . "',total_wages_ps='" . $_REQUEST["total_wages_ps"] . "',total_lavy_rs='" . $_REQUEST["total_lavy_rs"] . "',total_lavy_ps='" . $_REQUEST["total_lavy_ps"] . "',total_rs='" . $_REQUEST["total_rs"] . "',total_ps='" . $_REQUEST["total_ps"] . "',total_wages='" . $_REQUEST["total_wages"] . "',total_levy='" . $_REQUEST["total_levy"] . "',total_others='" . $_REQUEST["total_others"] . "',total='" . $_REQUEST["total"] . "',cheque_no='" . $_REQUEST["cheque_no"] . "',cheque_date='" . $_REQUEST["cheque_date"] . "',bank_name='" . $_REQUEST["bank_name"] . "',payment_mode='" . $_REQUEST["payment_mode"] . "',so_no='" . $_REQUEST["so_no"] . "',vehicle_no='" . $_REQUEST["vehicle_no"] . "',vehicle_date='" . $_REQUEST["vehicle_date"] . "',frieght_advance='" . $_REQUEST["frieght_advance"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ((isset($_REQUEST["wages_rs" . $i]) && !empty($_REQUEST["wages_rs" . $i]))) {

            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["receipt_date" . $i] . "','" . $_REQUEST["wages_rs" . $i] . "','" . $_REQUEST["wages_ps" . $i] . "','" . $_REQUEST["lavy_rs" . $i] . "','" . $_REQUEST["lavy_ps" . $i] . "','" . $_REQUEST["line_total_rs" . $i] . "','" . $_REQUEST["line_total_ps" . $i] . "')";
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