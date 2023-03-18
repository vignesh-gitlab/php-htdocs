<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_customer_order';
$return_page = 'customer_order_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "SELECT max(cast(order_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_order_no_prefix . $new_max_id;

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_id"] . "','" . $_REQUEST["order_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["so_date"] . "','" . $_REQUEST["order_date"] . "','" . $_REQUEST["order_time"] . "','" . $_REQUEST["vehicle_required_date"] . "','" . $_REQUEST["vehicle_required_time"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["pickup_address_line1"] . "','" . $_REQUEST["pickup_address_line2"] . "','" . $_REQUEST["pickup_city"] . "','" . $_REQUEST["pickup_pincode"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_ownership_type"] . "','" . $_REQUEST["vehicle_owner"] . "','" . $_REQUEST["primary_secondary"] . "','" . $_REQUEST["escort_type"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["email_id1"] . "','" . $_REQUEST["email_id2"] . "','" . $_REQUEST["email_id3"] . "','" . $_REQUEST["email_id4"] . "','" . $_REQUEST["email_id5"] . "','" . $_REQUEST["email_id6"] . "','" . $_REQUEST["email_id7"] . "','" . $_REQUEST["email_id8"] . "','" . $_REQUEST["email_id9"] . "','" . $_REQUEST["email_id10"] . "','" . $_REQUEST["mobile_no1"] . "','" . $_REQUEST["mobile_no2"] . "','" . $_REQUEST["mobile_no3"] . "','" . $_REQUEST["mobile_no4"] . "','" . $_REQUEST["mobile_no5"] . "','" . $_REQUEST["mobile_no6"] . "','" . $_REQUEST["mobile_no7"] . "','" . $_REQUEST["mobile_no8"] . "','" . $_REQUEST["mobile_no9"] . "','" . $_REQUEST["mobile_no10"] . "','Not Yet Booked','" . $_SESSION['username'] . "')";
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set client_name='" . $_REQUEST["client_name"] . "',client_division='" . $_REQUEST["client_division"] . "',client_branch='" . $_REQUEST["client_branch"] . "',order_date='" . $_REQUEST["order_date"] . "',order_time='" . $_REQUEST["order_time"] . "',vehicle_required_date='" . $_REQUEST["vehicle_required_date"] . "',vehicle_required_time='" . $_REQUEST["vehicle_required_time"] . "',orgin='" . $_REQUEST["orgin"] . "',destination='" . $_REQUEST["destination"] . "',pickup_address_line1='" . $_REQUEST["pickup_address_line1"] . "',pickup_address_line2='" . $_REQUEST["pickup_address_line2"] . "',pickup_city='" . $_REQUEST["pickup_city"] . "',pickup_pincode='" . $_REQUEST["pickup_pincode"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',vehicle_ownership_type='" . $_REQUEST["vehicle_ownership_type"] . "',vehicle_owner='" . $_REQUEST["vehicle_owner"] . "',primary_secondary='" . $_REQUEST["primary_secondary"] . "',description='" . $_REQUEST["description"] . "',email_id1='" . $_REQUEST["email_id1"] . "',email_id2='" . $_REQUEST["email_id2"] . "',email_id3='" . $_REQUEST["email_id3"] . "',email_id4='" . $_REQUEST["email_id4"] . "',email_id5='" . $_REQUEST["email_id5"] . "',email_id6='" . $_REQUEST["email_id6"] . "',email_id7='" . $_REQUEST["email_id7"] . "',email_id8='" . $_REQUEST["email_id8"] . "',email_id9='" . $_REQUEST["email_id9"] . "',email_id10='" . $_REQUEST["email_id10"] . "',mobile_no1='" . $_REQUEST["mobile_no1"] . "',mobile_no2='" . $_REQUEST["mobile_no2"] . "',mobile_no3='" . $_REQUEST["mobile_no3"] . "',mobile_no4='" . $_REQUEST["mobile_no4"] . "',mobile_no5='" . $_REQUEST["mobile_no5"] . "',mobile_no6='" . $_REQUEST["mobile_no6"] . "',mobile_no7='" . $_REQUEST["mobile_no7"] . "',mobile_no8='" . $_REQUEST["mobile_no8"] . "',mobile_no9='" . $_REQUEST["mobile_no9"] . "',mobile_no10='" . $_REQUEST["mobile_no10"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>