<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_escort';
$return_page = 'escort_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["escart_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["telephone_no"] . "','" . $_REQUEST["mobile_no"] . "','" . $_REQUEST["email_id"] . "','" . $_REQUEST["escart_type"] . "','" . $_REQUEST["contractor_name"] . "','" . $_REQUEST["description"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set escart_name='" . $_REQUEST["escart_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',telephone_no='" . $_REQUEST["telephone_no"] . "',mobile_no='" . $_REQUEST["mobile_no"] . "',email_id='" . $_REQUEST["email_id"] . "',escart_type='" . $_REQUEST["escart_type"] . "',contractor_name='" . $_REQUEST["contractor_name"] . "',description='" . $_REQUEST["description"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>