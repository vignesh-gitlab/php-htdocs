<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_quotation';
$tablename1 = 'sr_quotation_item';
$return_page = 'quotation_closed_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "SELECT max(cast(quotation_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_quotation_no_prefix . $new_max_id;

    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["quotation_date"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["vehicle_required_date"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["contact_no"] . "','" . $_REQUEST["tax_category"] . "','" . $_REQUEST["terms_and_condition"] . "','" . $_REQUEST["sub_total"] . "','" . $_REQUEST["sale_tax"] . "','" . $_REQUEST["discount"] . "','" . $_REQUEST["grand_total"] . "','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $new_max_orderno . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Duplicate") {

    $quotation_no = explode('.', $_REQUEST["quotation_no"]);
    $quotation_no_split = $quotation_no[0];
    $Query = "update $tablename set quotation_status='On Progress' where quotation_no LIKE'%" . $quotation_no_split . ".%'";
    $UDB->query($Query);

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["quotation_id"] . "','" . $_REQUEST["quotation_no"] . "','" . $_REQUEST["quotation_date"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["vehicle_required_date"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["contact_no"] . "','" . $_REQUEST["tax_category"] . "','" . $_REQUEST["terms_and_condition"] . "','" . $_REQUEST["sub_total"] . "','" . $_REQUEST["sale_tax"] . "','" . $_REQUEST["discount"] . "','" . $_REQUEST["grand_total"] . "','Open')";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["quotation_no"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set quotation_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $quotation_no_split = explode('.', $_REQUEST["quotation_no"]);
    $quotation_count = count($quotation_no_split);
    if ($quotation_count > 1) {
        //  $Query = "update sr_quotation set quotation_status='Close' where quotation_no ='" . $quotation_no_split[0] . "'";
        //  $UDB->query($Query);
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no like'" . $quotation_no_split[0] . ".%' and quotation_no<>'" . $_REQUEST["quotation_no"] . "'";
        $UDB->query($Query);
    }
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set quotation_date='" . $_REQUEST["quotation_date"] . "',description='" . $_REQUEST["description"] . "',vehicle_required_date='" . $_REQUEST["vehicle_required_date"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',client_name='" . $_REQUEST["client_name"] . "',division_name='" . $_REQUEST["division_name"] . "',branch_name='" . $_REQUEST["branch_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',contact_no='" . $_REQUEST["contact_no"] . "',tax_category='" . $_REQUEST["tax_category"] . "',terms_and_condition='" . $_REQUEST["terms_and_condition"] . "',sub_total='" . $_REQUEST["sub_total"] . "',total_tax='" . $_REQUEST["sale_tax"] . "',discount='" . $_REQUEST["discount"] . "',grand_total='" . $_REQUEST["grand_total"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where quotation_no='" . $_REQUEST["quotation_no"] . "'";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {

            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["quotation_no"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where quotation_id='" . $_REQUEST["quotation_id"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where quotation_no LIKE '%-" . $_REQUEST["quotation_id"] . "%'";
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Childdelete") {

    $Query = "delete from $tablename where quotation_no='" . $_REQUEST["quotation_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where quotation_no='" . $_REQUEST["quotation_no"] . "'";
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Close") {

    $quotation_no_split = explode('.', $_REQUEST["quotation_no"]);
    $quotation_count = count($quotation_no_split);
    if ($quotation_count > 1) {
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no ='" . $quotation_no_split[0] . "'";
        $UDB->query($Query);
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no like'" . $quotation_no_split[0] . ".%'";
        $UDB->query($Query);
    } else {
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no='" . $_REQUEST["quotation_no"] . "'";
        $UDB->query($Query);
    }

    $Query = "update sr_quotation set quotation_status='Close' where quotation_no='" . $_REQUEST["quotation_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>