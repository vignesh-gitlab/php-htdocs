<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lorry_arrival_report';
$return_page = 'vehicle_landing_grid.php';
$grid_page = 'lorry_arrival_report_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "SELECT max(cast(lar_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_lar_no_prefix . $new_max_id;

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["order_date"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["so_date"] . "','" . $new_max_id . "','" . $_REQUEST["lar_no"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["stationary_no"] . "','" . $_REQUEST["lorry_no"] . "','" . $_REQUEST["lar_date"] . "','" . $_REQUEST["lorry_from"] . "','" . $_REQUEST["dispatched_on"] . "','" . $_REQUEST["lorry_to"] . "','" . $_REQUEST["reporting_date"] . "','" . $_REQUEST["chellan_no"] . "','" . $_REQUEST["unloading_date"] . "','" . $_REQUEST["packages_load"] . "','" . $_REQUEST["packages_received"] . "','" . $_REQUEST["weight_loaded"] . "','" . $_REQUEST["weight_received"] . "','" . $_REQUEST["weight_loss"] . "','" . $_REQUEST["short_received"] . "','" . $_REQUEST["short_loss"] . "','" . $_REQUEST["damage_received"] . "','" . $_REQUEST["damage_loss"] . "','" . $_REQUEST["remarks_received"] . "','" . $_REQUEST["remarks_loss"] . "','" . $_REQUEST["consignment_received"] . "','" . $_REQUEST["consignment_loss"] . "','" . $_REQUEST["party_name_received"] . "','" . $_REQUEST["party_name_loss"] . "','Not Yet Released')";
    $UDB->query($Query);

    $Query = "update sr_vehicle_unloading set lar_status='2' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set lar_no='" . $_REQUEST["lar_no"] . "',branch='" . $_REQUEST["branch_code"] . "',stationary_no='" . $_REQUEST["stationary_no"] . "',lorry_no='" . $_REQUEST["lorry_no"] . "',lar_date='" . $_REQUEST["lar_date"] . "',lorry_from='" . $_REQUEST["lorry_from"] . "',dispatched_on='" . $_REQUEST["dispatched_on"] . "',lorry_to='" . $_REQUEST["lorry_to"] . "',reporting_date='" . $_REQUEST["reporting_date"] . "',chellan_no='" . $_REQUEST["chellan_no"] . "',unloading_date='" . $_REQUEST["unloading_date"] . "',packages_load='" . $_REQUEST["packages_load"] . "',packages_received='" . $_REQUEST["packages_received"] . "',weight_loaded='" . $_REQUEST["weight_loaded"] . "',weight_received='" . $_REQUEST["weight_received"] . "',weight_loss='" . $_REQUEST["weight_loss"] . "',short_received='" . $_REQUEST["short_received"] . "',short_loss='" . $_REQUEST["short_loss"] . "',damage_received='" . $_REQUEST["damage_received"] . "',damage_loss='" . $_REQUEST["damage_loss"] . "',remarks_received='" . $_REQUEST["remarks_received"] . "',remarks_loss='" . $_REQUEST["remarks_loss"] . "',consignment_received='" . $_REQUEST["consignment_received"] . "',consignment_loss='" . $_REQUEST["consignment_loss"] . "',party_name_received='" . $_REQUEST["party_name_received"] . "',party_name_loss='" . $_REQUEST["party_name_loss"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($grid_page);
?>