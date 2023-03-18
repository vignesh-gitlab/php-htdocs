<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_purchase_order';
$tablename1 = 'sr_purchase_order_item';
$return_page = 'purchase_order_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "SELECT max(cast(po_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_po_no_prefix . $new_max_id;

    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["po_date"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["vehicle_required_date"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["tax_category"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["contractor_name"] . "','" . $_REQUEST["contractor_address_line1"] . "','" . $_REQUEST["contractor_address_line2"] . "','" . $_REQUEST["contractor_city"] . "','" . $_REQUEST["contractor_pincode"] . "','" . $_REQUEST["contractor_contact_no"] . "','" . $_REQUEST["terms_and_condition"] . "','" . $_REQUEST["sub_total"] . "','" . $_REQUEST["sale_tax"] . "','" . $_REQUEST["discount"] . "','" . $_REQUEST["grand_total"] . "','" . $_REQUEST["mail_category"] . "','" . $_REQUEST["comment"] . "','" . $_SESSION["username"] . "','','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $new_max_orderno . "','" . $_REQUEST["vehicle_type" . $i] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set po_status='Approval',approved_by='" . $_SESSION["username"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set po_date='" . $_REQUEST["po_date"] . "',description='" . $_REQUEST["description"] . "',vehicle_required_date='" . $_REQUEST["vehicle_required_date"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',tax_category='" . $_REQUEST["tax_category"] . "',client_name='" . $_REQUEST["client_name"] . "',contractor_name='" . $_REQUEST["contractor_name"] . "',contractor_address_line1='" . $_REQUEST["contractor_address_line1"] . "',contractor_address_line2='" . $_REQUEST["contractor_address_line2"] . "',contractor_city='" . $_REQUEST["contractor_city"] . "',contractor_pincode='" . $_REQUEST["contractor_pincode"] . "',contractor_contact_no='" . $_REQUEST["contractor_contact_no"] . "',terms_and_condition='" . $_REQUEST["terms_and_condition"] . "',sub_total='" . $_REQUEST["sub_total"] . "',total_tax='" . $_REQUEST["sale_tax"] . "',discount='" . $_REQUEST["discount"] . "',grand_total='" . $_REQUEST["grand_total"] . "',mail_category='" . $_REQUEST["mail_category"] . "',comment='" . $_REQUEST["comment"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where po_no='" . $_REQUEST["po_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["po_no"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where po_no='" . $_REQUEST["po_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where po_no='" . $_REQUEST["po_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>