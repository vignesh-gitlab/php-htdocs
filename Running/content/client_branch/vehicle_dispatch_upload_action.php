<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_dispatch';
$return_page = 'vehicle_dispatch_closed_grid.php';
$registered_at = $FN->return_date_time();



if ($_FILES["lr_copy"]["error"] > 0) {
    echo "Return Code: " . $_FILES["lr_copy"]["error"] . "<br />";
} else {
    move_uploaded_file($_FILES["lr_copy"]["tmp_name"], "../../files/Vehicle Dispatch/LR Copy/" . $_FILES["lr_copy"]["name"]);
}
$lr_filename = $_FILES["lr_copy"]["name"];
if ($_FILES["invoice_copy"]["error"] > 0) {
    echo "Return Code: " . $_FILES["invoice_copy"]["error"] . "<br />";
} else {
    move_uploaded_file($_FILES["invoice_copy"]["tmp_name"], "../../files/Vehicle Dispatch/Invoice Copy/" . $_FILES["invoice_copy"]["name"]);
}
$invoice_filename = $_FILES["invoice_copy"]["name"];



$Query = "update sr_vehicle_dispatch set lr_upload='" . $lr_filename . "',invoice_upload='" . $invoice_filename . "' where order_no='" . $_REQUEST["order_no"] . "'";
$UDB->query($Query);

$FN->page_redirect($return_page);
?>