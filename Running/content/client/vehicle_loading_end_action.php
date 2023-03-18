<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_loading_end';
$return_page = 'vehicle_loading_start_grid.php';
$grid_page = 'vehicle_loading_end_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["placement_date"] . "','" . $_REQUEST["placement_time"] . "','" . $_REQUEST["loading_start_date"] . "','" . $_REQUEST["loading_start_time"] . "','" . $_REQUEST["loading_end_date"] . "','" . $_REQUEST["loading_end_time"] . "','Not Yet Dispatched','" . $_SESSION['username'] . "')";
    $UDB->query($Query);

    $Query = "update sr_vehicle_loading_start set loading_status='Loaded' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $FN->page_redirect($return_page);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set loading_end_date='" . $_REQUEST["loading_end_date"] . "',loading_end_time='" . $_REQUEST["loading_end_time"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
}
?>