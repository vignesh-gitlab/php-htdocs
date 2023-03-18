<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_unloading';
$return_page = 'vehicle_landing_grid.php';
$grid_page = 'vehicle_unloading_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["dispatch_date"] . "','" . $_REQUEST["dispatch_time"] . "','" . $_REQUEST["expected_dateof_delivery"] . "','" . $_REQUEST["landing_date"] . "','" . $_REQUEST["landing_time"] . "','" . $_REQUEST["unloading_date"] . "','" . $_REQUEST["unloading_time"] . "','Not Yet Reported','0','" . $_SESSION['username'] . "')";
    $UDB->query($Query);

    $Query = "update sr_vehicle_landing set landing_status='Unloaded' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $FN->page_redirect($return_page);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set unloading_date='" . $_REQUEST["unloading_date"] . "',unloading_time='" . $_REQUEST["unloading_time"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
}
?>