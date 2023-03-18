<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_reporting';
$return_page = 'vehicle_reporting_closed_grid.php';
$grid_page = 'vehicle_reporting_grid.php';
$registered_at = $FN->return_date_time();

if ($_FILES["pod_upload"]["error"] > 0) {
    //echo "Return Code: " . $_FILES["lr_copy"]["error"] . "<br />";
} else {
    move_uploaded_file($_FILES["pod_upload"]["tmp_name"], "../../files/POD Copy/" . $_FILES["pod_upload"]["name"]);
}
$filename = $_FILES["pod_upload"]["name"];

$Query = "update sr_vehicle_reporting set pod_name='" . $filename . "' where order_no='" . $_REQUEST["order_no"] . "'";
$UDB->query($Query);

$FN->page_redirect($return_page);
?>