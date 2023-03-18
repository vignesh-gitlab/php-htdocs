<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_lane';
$return_page = 'lane_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["lane_id"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_from"] . "','" . $_REQUEST["lane_to"] . "','" . $_REQUEST["total_km_one_way"] . "','" . $_REQUEST["total_km_trip"] . "','" . $_REQUEST["lane_category"] . "','" . $_REQUEST["lane_category_name"] . "','" . $_REQUEST["rate"] . "','" . $_REQUEST["duration"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set lane_id='" . $_REQUEST["lane_id"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',lane_from='" . $_REQUEST["lane_from"] . "',lane_to='" . $_REQUEST["lane_to"] . "',total_km_one_way='" . $_REQUEST["total_km_one_way"] . "',total_km_trip='" . $_REQUEST["total_km_trip"] . "',lane_category='" . $_REQUEST["lane_category"] . "',lane_category_name='" . $_REQUEST["lane_category_name"] . "',rate='" . $_REQUEST["rate"] . "',duration='" . $_REQUEST["duration"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>