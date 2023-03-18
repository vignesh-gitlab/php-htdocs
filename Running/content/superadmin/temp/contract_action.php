<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contract';
$return_page = 'contract_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["agreement_no"] . "','" . $_REQUEST["effective_date"] . "','" . $_REQUEST["expiry_date"] . "','" . $_REQUEST["outstanding_valid_from"] . "','" . $_REQUEST["lane_id"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_from"] . "','" . $_REQUEST["lane_to"] . "','" . $_REQUEST["total_km_one_way"] . "','" . $_REQUEST["total_km_trip"] . "','" . $_REQUEST["lane_category"] . "','" . $_REQUEST["lane_category_name"] . "','" . $_REQUEST["charge_base"] . "','" . $_REQUEST["type_of_movement"] . "','" . $_REQUEST["rate"] . "','" . $_REQUEST["duration"] . "','" . $_REQUEST["due_day"] . "','" . $_REQUEST["remarks"] . "','Open')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    if ($_REQUEST["form_action1"] == "Copy") {

        $Query = "update $tablename set status='Close' where id=" . $_REQUEST["id"];
        $DB->query($Query);

        $Query = "insert into $tablename values(NULL,'" . $_REQUEST["agreement_no"] . "','','','" . $_REQUEST["outstanding_valid_from"] . "','" . $_REQUEST["lane_id"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_from"] . "','" . $_REQUEST["lane_to"] . "','" . $_REQUEST["total_km_one_way"] . "','" . $_REQUEST["total_km_trip"] . "','" . $_REQUEST["lane_category"] . "','" . $_REQUEST["lane_category_name"] . "','" . $_REQUEST["charge_base"] . "','" . $_REQUEST["type_of_movement"] . "','" . $_REQUEST["rate"] . "','" . $_REQUEST["duration"] . "','" . $_REQUEST["due_day"] . "','" . $_REQUEST["remarks"] . "','Open')";
        $DB->query($Query);
    } else {
        $Query = "update $tablename set agreement_no='" . $_REQUEST["agreement_no"] . "',effective_date='" . $_REQUEST["effective_date"] . "',expiry_date='" . $_REQUEST["expiry_date"] . "',outstanding_valid_from='" . $_REQUEST["outstanding_valid_from"] . "',lane_id='" . $_REQUEST["lane_id"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',lane_from='" . $_REQUEST["lane_from"] . "',lane_to='" . $_REQUEST["lane_to"] . "',total_km_one_way='" . $_REQUEST["total_km_one_way"] . "',total_km_trip='" . $_REQUEST["total_km_trip"] . "',lane_category='" . $_REQUEST["lane_category"] . "',lane_category_name='" . $_REQUEST["lane_category_name"] . "',charge_base='" . $_REQUEST["charge_base"] . "',type_of_movement='" . $_REQUEST["type_of_movement"] . "',rate='" . $_REQUEST["rate"] . "',duration='" . $_REQUEST["duration"] . "',due_day='" . $_REQUEST["due_day"] . "',remarks='" . $_REQUEST["remarks"] . "' where id=" . $_REQUEST["id"];
        $DB->query($Query);
    }
} /* else if ($_REQUEST["form_action"] == "Copy") {
  $Query = "update $tablename set status='Close' where id=" . $_REQUEST["id"];
  $DB->query($Query);

  $Query = "insert into $tablename values(NULL,'" . $_REQUEST["agreement_no"] . "','','','" . $_REQUEST["outstanding_valid_from"] . "','" . $_REQUEST["lane_id"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["lane_from"] . "','" . $_REQUEST["lane_to"] . "','" . $_REQUEST["total_km_one_way"] . "','" . $_REQUEST["total_km_trip"] . "','" . $_REQUEST["lane_category"] . "','" . $_REQUEST["lane_category_name"] . "','" . $_REQUEST["charge_base"] . "','" . $_REQUEST["type_of_movement"] . "','" . $_REQUEST["rate"] . "','" . $_REQUEST["duration"] . "','" . $_REQUEST["due_day"] . "','','Open')";
  $DB->query($Query);
  } */
$FN->page_redirect($return_page);
?>