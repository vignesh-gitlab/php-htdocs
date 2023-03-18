<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lorry_chellan';
$tablename1 = 'sr_lorry_chellan_item';
$return_page = 'vehicle_placement_grid.php';
$return_page = 'bilty_grid.php';
$grid_page = 'lorry_chellan_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["order_date"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["so_date"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_city"] . "','" . $_REQUEST["stationary_no"] . "','" . $_REQUEST["lorry_chellan_no"] . "','" . $_REQUEST["lorry_chellan_date"] . "','" . $_REQUEST["lorry_from"] . "','" . $_REQUEST["lorry_to"] . "','" . $_REQUEST["lorry_no"] . "','" . $_REQUEST["branch"] . "','" . $_REQUEST["chassis_no"] . "','" . $_REQUEST["engine_no"] . "','" . $_REQUEST["owner_name"] . "','" . $_REQUEST["owner_address_line1"] . "','" . $_REQUEST["owner_address_line2"] . "','" . $_REQUEST["owner_city"] . "','" . $_REQUEST["owner_pincode"] . "','" . $_REQUEST["driver_name"] . "','" . $_REQUEST["license_no"] . "','" . $_REQUEST["driver_address_line1"] . "','" . $_REQUEST["driver_address_line2"] . "','" . $_REQUEST["driver_city"] . "','" . $_REQUEST["driver_pincode"] . "','" . $_REQUEST["lorry_model"] . "','" . $_REQUEST["lorry_color"] . "','" . $_REQUEST["lorry_make"] . "','" . $_REQUEST["permit_status"] . "','" . $_REQUEST["permit_valid_upto"] . "','" . $_REQUEST["ongaged_through"] . "','" . $_REQUEST["delivery_date"] . "','" . $_REQUEST["destination_address_line1"] . "','" . $_REQUEST["destination_address_line2"] . "','" . $_REQUEST["destination_city"] . "','" . $_REQUEST["destination_pincode"] . "','" . $_REQUEST["total_packages"] . "','" . $_REQUEST["rate_per_ton"] . "','" . $_REQUEST["rate_per_kg"] . "','" . $_REQUEST["frieght"] . "','" . $_REQUEST["extra_for"] . "','" . $_REQUEST["total"] . "','" . $_REQUEST["advance"] . "','" . $_REQUEST["less_tds"] . "','" . $_REQUEST["balance"] . "','Not Yet Released')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if (($_REQUEST["code" . $i] != "Select") || (isset($_REQUEST["code_name" . $i]) && !empty($_REQUEST["code_name" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["lorry_chellan_no"] . "','" . $_REQUEST["code_name" . $i] . "','" . $_REQUEST["consignment_no" . $i] . "','" . $_REQUEST["no_of_packages" . $i] . "','" . $_REQUEST["packing" . $i] . "','" . $_REQUEST["description" . $i] . "','" . $_REQUEST["weight" . $i] . "','" . $_REQUEST["destination" . $i] . "','" . $_REQUEST["to_pay" . $i] . "')";
            $UDB->query($Query);
        }
    }
    /* $Query = "update sr_bilty set bilty_status='Released' where order_no='" . $_REQUEST["order_no"] . "'";
      $UDB->query($Query); */
    $FN->page_redirect($return_page);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set branch_code='" . $_REQUEST["branch_code"] . "',branch_city='" . $_REQUEST["branch_city"] . "',stationary_no='" . $_REQUEST["stationary_no"] . "',lorry_chellan_no='" . $_REQUEST["lorry_chellan_no"] . "',lorry_chellan_date='" . $_REQUEST["lorry_chellan_date"] . "',lorry_from='" . $_REQUEST["lorry_from"] . "',lorry_to='" . $_REQUEST["lorry_to"] . "',lorry_no='" . $_REQUEST["lorry_no"] . "',branch='" . $_REQUEST["branch"] . "',chassis_no='" . $_REQUEST["chassis_no"] . "',engine_no='" . $_REQUEST["engine_no"] . "',owner_name='" . $_REQUEST["owner_name"] . "',owner_address_line1='" . $_REQUEST["owner_address_line1"] . "',owner_address_line2='" . $_REQUEST["owner_address_line2"] . "',owner_city='" . $_REQUEST["owner_city"] . "',owner_pincode='" . $_REQUEST["owner_pincode"] . "',driver_name='" . $_REQUEST["driver_name"] . "',license_no='" . $_REQUEST["license_no"] . "',driver_address_line1='" . $_REQUEST["driver_address_line1"] . "',driver_address_line2='" . $_REQUEST["driver_address_line2"] . "',driver_city='" . $_REQUEST["driver_city"] . "',driver_pincode='" . $_REQUEST["driver_pincode"] . "',lorry_model='" . $_REQUEST["lorry_model"] . "',lorry_color='" . $_REQUEST["lorry_color"] . "',lorry_make='" . $_REQUEST["lorry_make"] . "',permit_status='" . $_REQUEST["permit_status"] . "',permit_valid_upto='" . $_REQUEST["permit_valid_upto"] . "',ongaged_through='" . $_REQUEST["ongaged_through"] . "',delivery_date='" . $_REQUEST["delivery_date"] . "',destination_address_line1='" . $_REQUEST["destination_address_line1"] . "',destination_address_line2='" . $_REQUEST["destination_address_line2"] . "',destination_city='" . $_REQUEST["destination_city"] . "',destination_pincode='" . $_REQUEST["destination_pincode"] . "',total_packages='" . $_REQUEST["total_packages"] . "',rate_per_ton='" . $_REQUEST["rate_per_ton"] . "',rate_per_kg='" . $_REQUEST["rate_per_kg"] . "',frieght='" . $_REQUEST["frieght"] . "',extra_for='" . $_REQUEST["extra_for"] . "',total='" . $_REQUEST["total"] . "',advance='" . $_REQUEST["advance"] . "',less_tds='" . $_REQUEST["less_tds"] . "',balance='" . $_REQUEST["balance"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if (($_REQUEST["code" . $i] != "Select") || (isset($_REQUEST["code_name" . $i]) && !empty($_REQUEST["code_name" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["lorry_chellan_no"] . "','" . $_REQUEST["code_name" . $i] . "','" . $_REQUEST["consignment_no" . $i] . "','" . $_REQUEST["no_of_packages" . $i] . "','" . $_REQUEST["packing" . $i] . "','" . $_REQUEST["description" . $i] . "','" . $_REQUEST["weight" . $i] . "','" . $_REQUEST["destination" . $i] . "','" . $_REQUEST["to_pay" . $i] . "')";
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