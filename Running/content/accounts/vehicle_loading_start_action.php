<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_loading_start';
$return_page = 'lorry_chellan_grid.php';
$grid_page = 'vehicle_loading_start_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["placement_date"] . "','" . $_REQUEST["placement_time"] . "','" . $_REQUEST["loading_start_date"] . "','" . $_REQUEST["loading_start_time"] . "','Not Yet Loaded','" . $_SESSION['username'] . "')";
    $UDB->query($Query);
    //$FN->page_redirect($return_page);

    $Query = "update sr_vehicle_placement set placement_status='Released' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
    /* $Query = "update sr_lorry_chellan set lc_status='Released' where order_no='" . $_REQUEST["order_no"] . "'";
      $UDB->query($Query); */
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set loading_start_date='" . $_REQUEST["loading_start_date"] . "',loading_start_time='" . $_REQUEST["loading_start_time"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
}
?>