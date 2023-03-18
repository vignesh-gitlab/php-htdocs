<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_reporting';
$return_page = 'lorry_arrival_report_grid.php';
$grid_page = 'vehicle_reporting_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    if ($_FILES["pod_upload"]["error"] > 0) {
        //echo "Return Code: " . $_FILES["lr_copy"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["pod_upload"]["tmp_name"], "../../files/POD Copy/" . $_FILES["pod_upload"]["name"]);
    }
    $filename = $_FILES["pod_upload"]["name"];

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["dispatch_date"] . "','" . $_REQUEST["dispatch_time"] . "','" . $_REQUEST["expected_dateof_delivery"] . "','" . $_REQUEST["landing_date"] . "','" . $_REQUEST["landing_time"] . "','" . $_REQUEST["unloading_date"] . "','" . $_REQUEST["unloading_time"] . "','" . $_REQUEST["vehicle_release_date"] . "','" . $_REQUEST["vehicle_release_time"] . "','" . $_REQUEST["no_of_pack"] . "','" . $_REQUEST["weight"] . "','" . $_REQUEST["damages"] . "','" . $_REQUEST["remarks"] . "','" . $filename . "','Reported','" . $_SESSION['username'] . "')";
    $UDB->query($Query);
    /* $Query = "update sr_lorry_arrival_report set lar_status='Released' where order_no='" . $_REQUEST["order_no"] . "'";
      $UDB->query($Query); */
    $Query = "update sr_vehicle_unloading set unloading_status='Reported',lar_status='1' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    $Query = "update sr_customer_order set order_status='Delivered' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);


    $FN->page_redirect($grid_page);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set vehicle_release_date='" . $_REQUEST["vehicle_release_date"] . "',no_of_pack='" . $_REQUEST["no_of_pack"] . "',weight='" . $_REQUEST["weight"] . "',damages='" . $_REQUEST["damages"] . "',remarks='" . $_REQUEST["remarks"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
} else if ($_REQUEST["form_action"] == "Finalize") {
    $Query = "update $tablename set reporting_status='Finalized' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "update sr_vehicle set availablity='Yes' where registration_no='" . $_REQUEST["vehicle_no"] . "'";
    $DB->query($Query);

    $FN->page_redirect($grid_page);
}
?>