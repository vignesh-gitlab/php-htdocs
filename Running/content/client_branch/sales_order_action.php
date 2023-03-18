<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_sales_order';
$tablename1 = 'sr_sales_order_item';
$return_page = 'sales_order_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "SELECT max(cast(so_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_so_no_prefix . $new_max_id;

    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["so_date"] . "','" . $_REQUEST["quotation_ref_no"] . "','" . $_REQUEST["quotation_date"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["vehicle_required_date"] . "','" . $_REQUEST["tax_category"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["contact_no"] . "','" . $_REQUEST["terms_and_condition"] . "','" . $_REQUEST["sub_total"] . "','" . $_REQUEST["sale_tax"] . "','" . $_REQUEST["discount"] . "','" . $_REQUEST["grand_total"] . "','" . $_SESSION["username"] . "','','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $new_max_orderno . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
    /* $quotation_no_split = explode('.', $_REQUEST["quotation_ref_no"]);
      $quotation_count = count($quotation_no_split);
      if ($quotation_count > 1) {
      $Query = "update sr_quotation set quotation_status='Close' where quotation_no ='" . $quotation_no_split[0] . "'";
      $UDB->query($Query);
      $Query = "update sr_quotation set quotation_status='Close' where quotation_no like'" . $quotation_no_split[0] . ".%'";
      $UDB->query($Query);
      } else {
      $Query = "update sr_quotation set quotation_status='Close' where quotation_no='" . $_REQUEST["quotation_ref_no"] . "'";
      $UDB->query($Query);
      }

      $Query = "update sr_quotation set quotation_status='Close' where quotation_no='" . $_REQUEST["quotation_ref_no"] . "'";
     */
    //  $UDB->query($Query);
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set so_status='Approval',approved_by='" . $_SESSION["username"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $quotation_no_split = explode('.', $_REQUEST["quotation_ref_no"]);
    $quotation_count = count($quotation_no_split);
    if ($quotation_count > 1) {
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no ='" . $quotation_no_split[0] . "'";
        $UDB->query($Query);
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no like'" . $quotation_no_split[0] . ".%'";
        $UDB->query($Query);
    } else {
        $Query = "update sr_quotation set quotation_status='Close' where quotation_no='" . $_REQUEST["quotation_ref_no"] . "'";
        $UDB->query($Query);
    }

    $Query = "update sr_quotation set quotation_status='Close' where quotation_no='" . $_REQUEST["quotation_ref_no"] . "'";
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set so_date='" . $_REQUEST["so_date"] . "',description='" . $_REQUEST["description"] . "',vehicle_required_date='" . $_REQUEST["vehicle_required_date"] . "',tax_category='" . $_REQUEST["tax_category"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',client_name='" . $_REQUEST["client_name"] . "',division_name='" . $_REQUEST["division_name"] . "',branch_name='" . $_REQUEST["branch_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',contact_no='" . $_REQUEST["contact_no"] . "',terms_and_condition='" . $_REQUEST["terms_and_condition"] . "',sub_total='" . $_REQUEST["sub_total"] . "',total_tax='" . $_REQUEST["sale_tax"] . "',discount='" . $_REQUEST["discount"] . "',grand_total='" . $_REQUEST["grand_total"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where so_no='" . $_REQUEST["so_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["lane_from" . $i]) && !empty($_REQUEST["lane_from" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["so_no"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["lane_from" . $i] . "','" . $_REQUEST["lane_to" . $i] . "','" . $_REQUEST["line_total" . $i] . "','" . $_REQUEST["ex_total" . $i] . "','" . $_REQUEST["tax_rate" . $i] . "','" . $_REQUEST["tax_type" . $i] . "','" . $_REQUEST["line_tax" . $i] . "','" . $_REQUEST["amount" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where so_no='" . $_REQUEST["so_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where so_no='" . $_REQUEST["so_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>