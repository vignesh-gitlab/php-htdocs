<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_contract';
$tablename1 = 'sr_contract_item';
$return_page = 'contract_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "SELECT max(cast(contract_no as unsigned))as max_id from $tablename";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $max_id = $DB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;

    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $_REQUEST["customer_name"] . "','" . $_REQUEST["agreement_no"] . "','" . $_REQUEST["effective_date"] . "','" . $_REQUEST["expiry_date"] . "','" . $_REQUEST["outstanding_valid_from"] . "','" . $_REQUEST["due_day"] . "','Open')";
    $DB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["departure" . $i]) && !empty($_REQUEST["departure" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $new_max_id . "','" . $_REQUEST["effective_date_item" . $i] . "','" . $_REQUEST["expiry_date_item" . $i] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["departure" . $i] . "','" . $_REQUEST["arrival" . $i] . "','" . $_REQUEST["vehicle_type" . $i] . "','" . $_REQUEST["type_of_movement" . $i] . "','" . $_REQUEST["charge_base" . $i] . "','" . $_REQUEST["charges" . $i] . "','" . $_REQUEST["duration" . $i] . "','" . $_REQUEST["remarks" . $i] . "')";
            $DB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set customer_name='" . $_REQUEST["customer_name"] . "',agreement_no='" . $_REQUEST["agreement_no"] . "',effective_date='" . $_REQUEST["effective_date"] . "',expiry_date='" . $_REQUEST["expiry_date"] . "',outstanding_valid_from='" . $_REQUEST["outstanding_valid_from"] . "',due_day='" . $_REQUEST["due_day"] . "',status='" . $_REQUEST["status"] . "' where contract_no=" . $_REQUEST["contract_no"];
    $DB->query($Query);

    $Query = "delete from $tablename1 where contract_no='" . $_REQUEST["contract_no"] . "'";
    $DB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["departure" . $i]) && !empty($_REQUEST["departure" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["contract_no"] . "','" . $_REQUEST["effective_date_item" . $i] . "','" . $_REQUEST["expiry_date_item" . $i] . "','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["departure" . $i] . "','" . $_REQUEST["arrival" . $i] . "','" . $_REQUEST["vehicle_type" . $i] . "','" . $_REQUEST["type_of_movement" . $i] . "','" . $_REQUEST["charge_base" . $i] . "','" . $_REQUEST["charges" . $i] . "','" . $_REQUEST["duration" . $i] . "','" . $_REQUEST["remarks" . $i] . "')";
            $DB->query($Query);
        }
    }
} else if ($_REQUEST["form_action1"] == "Copy") {
    $Query = "update $tablename set status='Close' where id=" . $_REQUEST["id"];
    $DB->query($Query);

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["contract_no"] . "','" . $_REQUEST["customer_name"] . "','" . $_REQUEST["agreement_no"] . "','" . $_REQUEST["effective_date"] . "','" . $_REQUEST["expiry_date"] . "','" . $_REQUEST["outstanding_valid_from"] . "','" . $_REQUEST["due_day"] . "','Open')";
    $DB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["lane_id" . $i] != "Select" || (isset($_REQUEST["departure" . $i]) && !empty($_REQUEST["departure" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["contract_no"] . "','','','" . $_REQUEST["lane_id" . $i] . "','" . $_REQUEST["departure" . $i] . "','" . $_REQUEST["arrival" . $i] . "','" . $_REQUEST["vehicle_type" . $i] . "','" . $_REQUEST["type_of_movement" . $i] . "','" . $_REQUEST["charge_base" . $i] . "','" . $_REQUEST["charges" . $i] . "','" . $_REQUEST["duration" . $i] . "','" . $_REQUEST["remarks" . $i] . "')";
            $DB->query($Query);
        }
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where contract_no='" . $_REQUEST["contract_no"] . "'";
    $DB->query($Query);
    $Query = "delete from $tablename1 where contract_no='" . $_REQUEST["contract_no"] . "'";
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>