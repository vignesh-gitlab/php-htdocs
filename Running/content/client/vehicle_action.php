<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle';
$return_page = 'vehicle_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["manufacturer"] . "','" . $_REQUEST["year_of_manufacturer"] . "','" . $_REQUEST["model_no"] . "','" . $_REQUEST["color"] . "','" . $_REQUEST["chase_no"] . "','" . $_REQUEST["registration_no"] . "','" . $_REQUEST["ownership"] . "','" . $_REQUEST["vendor_name"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["permit_type"] . "','" . $_REQUEST["permit_expires_on"] . "','" . $_REQUEST["last_fc_date"] . "','" . $_REQUEST["next_fc_date"] . "','" . $_REQUEST["last_service_date"] . "','" . $_REQUEST["next_service_date"] . "','Yes')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set vehicle_type='" . $_REQUEST["vehicle_type"] . "',manufacturer='" . $_REQUEST["manufacturer"] . "',year_of_manufacturer='" . $_REQUEST["year_of_manufacturer"] . "',model_no='" . $_REQUEST["model_no"] . "',color='" . $_REQUEST["color"] . "',chase_no='" . $_REQUEST["chase_no"] . "',registration_no='" . $_REQUEST["registration_no"] . "',ownership='" . $_REQUEST["ownership"] . "',vendor_name='" . $_REQUEST["vendor_name"] . "',description='" . $_REQUEST["description"] . "',permit_type='" . $_REQUEST["permit_type"] . "',permit_expires_on='" . $_REQUEST["permit_expires_on"] . "',last_fc_date='" . $_REQUEST["last_fc_date"] . "',next_fc_date='" . $_REQUEST["next_fc_date"] . "',last_service_date='" . $_REQUEST["last_service_date"] . "',next_service_date='" . $_REQUEST["next_service_date"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Reset") {
    $Query = "update $tablename set availablity='Yes' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>