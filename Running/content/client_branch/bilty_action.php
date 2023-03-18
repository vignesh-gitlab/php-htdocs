<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_bilty';
$tablename1 = 'sr_bilty_item';
$return_page = 'vehicle_placement_grid.php';
$grid_page = 'bilty_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["order_date"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["so_date"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_city"] . "','" . $_REQUEST["consignor_name"] . "','" . $_REQUEST["consignor_address_line1"] . "','" . $_REQUEST["consignor_address_line2"] . "','" . $_REQUEST["consignor_city"] . "','" . $_REQUEST["consignor_pincode"] . "','" . $_REQUEST["po_no"] . "','" . $_REQUEST["consignor_invoice_no"] . "','" . $_REQUEST["consignor_tin_no"] . "','" . $_REQUEST["stationary_no"] . "','" . $_REQUEST["consignment_note_no"] . "','" . $_REQUEST["consignment_date"] . "','" . $_REQUEST["lane_from"] . "','" . $_REQUEST["lane_to"] . "','" . $_REQUEST["consignee_account_no"] . "','" . $_REQUEST["consignee_account_name"] . "','" . $_REQUEST["consignee_bank"] . "','" . $_REQUEST["consignee_branch"] . "','" . $_REQUEST["to_be_billed_at"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["container_no"] . "','" . $_REQUEST["booking_company_name"] . "','" . $_REQUEST["booking_address_line1"] . "','" . $_REQUEST["booking_address_line2"] . "','" . $_REQUEST["booking_city"] . "','" . $_REQUEST["booking_pincode"] . "','" . $_REQUEST["delivery_company_name"] . "','" . $_REQUEST["delivery_address_line1"] . "','" . $_REQUEST["delivery_address_line2"] . "','" . $_REQUEST["delivery_city"] . "','" . $_REQUEST["bill_party"] . "','" . $_REQUEST["bill_vide_permit_no"] . "','" . $_REQUEST["delivery_pincode"] . "','" . $_REQUEST["service_tax_payable_by"] . "','" . $_REQUEST["packing"] . "','" . $_REQUEST["private_note"] . "','" . $_REQUEST["bill_type"] . "','" . $_REQUEST["total_frieght"] . "','" . $_REQUEST["hamall"] . "','" . $_REQUEST["sur_charges"] . "','" . $_REQUEST["st_charges"] . "','" . $_REQUEST["risk_charges"] . "','" . $_REQUEST["checkpost"] . "','" . $_REQUEST["fov"] . "','" . $_REQUEST["total"] . "','" . $_REQUEST["insurance"] . "','" . $_REQUEST["insurance_company"] . "','" . $_REQUEST["policy_no"] . "','" . $_REQUEST["insurance_date"] . "','" . $_REQUEST["insurance_amount"] . "','" . $_REQUEST["risk"] . "','Not Yet Released')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["description" . $i] != "" || (isset($_REQUEST["packages" . $i]) && !empty($_REQUEST["packages" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["description" . $i] . "','" . $_REQUEST["product_category" . $i] . "','" . $_REQUEST["product_name" . $i] . "','" . $_REQUEST["packages_unit" . $i] . "','" . $_REQUEST["packages" . $i] . "','" . $_REQUEST["weight_actual" . $i] . "','" . $_REQUEST["weight_charged" . $i] . "','" . $_REQUEST["frieght_charge" . $i] . "')";
            $UDB->query($Query);
        }
    }
    $Query = "update sr_vehicle_placement set bilty_status='2' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $FN->page_redirect($return_page);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set branch_code='" . $_REQUEST["branch_code"] . "',branch_city='" . $_REQUEST["branch_city"] . "',consignor_name='" . $_REQUEST["consignor_name"] . "',consignor_address_line1='" . $_REQUEST["consignor_address_line1"] . "',consignor_address_line2='" . $_REQUEST["consignor_address_line2"] . "',consignor_city='" . $_REQUEST["consignor_city"] . "',consignor_pincode='" . $_REQUEST["consignor_pincode"] . "',po_no='" . $_REQUEST["po_no"] . "',consignor_invoice_no='" . $_REQUEST["consignor_invoice_no"] . "',consignor_tin_no='" . $_REQUEST["consignor_tin_no"] . "',stationary_no='" . $_REQUEST["stationary_no"] . "',consignment_note_no='" . $_REQUEST["consignment_note_no"] . "',consignment_date='" . $_REQUEST["consignment_date"] . "',lane_from='" . $_REQUEST["lane_from"] . "',lane_to='" . $_REQUEST["lane_to"] . "',consignee_account_no='" . $_REQUEST["consignee_account_no"] . "',consignee_account_name='" . $_REQUEST["consignee_account_name"] . "',consignee_bank='" . $_REQUEST["consignee_bank"] . "',consignee_branch='" . $_REQUEST["consignee_branch"] . "',to_be_billed_at='" . $_REQUEST["to_be_billed_at"] . "',vehicle_no='" . $_REQUEST["vehicle_no"] . "',container_no='" . $_REQUEST["container_no"] . "',booking_company_name='" . $_REQUEST["booking_company_name"] . "',booking_address_line1='" . $_REQUEST["booking_address_line1"] . "',booking_address_line2='" . $_REQUEST["booking_address_line2"] . "',booking_city='" . $_REQUEST["booking_city"] . "',booking_pincode='" . $_REQUEST["booking_pincode"] . "',delivery_company_name='" . $_REQUEST["delivery_company_name"] . "',delivery_address_line1='" . $_REQUEST["delivery_address_line1"] . "',delivery_address_line2='" . $_REQUEST["delivery_address_line2"] . "',delivery_city='" . $_REQUEST["delivery_city"] . "',bill_party='" . $_REQUEST["bill_party"] . "',bill_vide_permit_no='" . $_REQUEST["bill_vide_permit_no"] . "',delivery_pincode='" . $_REQUEST["delivery_pincode"] . "',service_tax_payable_by='" . $_REQUEST["service_tax_payable_by"] . "',packing='" . $_REQUEST["packing"] . "',private_note='" . $_REQUEST["private_note"] . "',bill_type='" . $_REQUEST["bill_type"] . "',total_frieght='" . $_REQUEST["total_frieght"] . "',hamall='" . $_REQUEST["hamall"] . "',sur_charges='" . $_REQUEST["sur_charges"] . "',st_charges='" . $_REQUEST["st_charges"] . "',risk_charges='" . $_REQUEST["risk_charges"] . "',checkpost='" . $_REQUEST["checkpost"] . "',fov='" . $_REQUEST["fov"] . "',total='" . $_REQUEST["total"] . "',insurance='" . $_REQUEST["insurance"] . "',insurance_company='" . $_REQUEST["insurance_company"] . "',policy_no='" . $_REQUEST["policy_no"] . "',insurance_date='" . $_REQUEST["insurance_date"] . "',insurance_amount='" . $_REQUEST["insurance_amount"] . "',risk='" . $_REQUEST["risk"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["description" . $i] != "" || (isset($_REQUEST["packages" . $i]) && !empty($_REQUEST["packages" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["description" . $i] . "','" . $_REQUEST["product_category" . $i] . "','" . $_REQUEST["product_name" . $i] . "','" . $_REQUEST["packages_unit" . $i] . "','" . $_REQUEST["packages" . $i] . "','" . $_REQUEST["weight_actual" . $i] . "','" . $_REQUEST["weight_charged" . $i] . "','" . $_REQUEST["frieght_charge" . $i] . "')";
            $UDB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($grid_page);
?>