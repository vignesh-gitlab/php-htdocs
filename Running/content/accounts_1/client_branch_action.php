<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_client';
$return_page = 'client_branch_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["telephone_no"] . "','" . $_REQUEST["mobile_no"] . "','" . $_REQUEST["fax_no"] . "','" . $_REQUEST["email_id"] . "','" . $_REQUEST["tin_no"] . "','" . $_REQUEST["cst_no"] . "','" . $_REQUEST["contact_person_name1"] . "','" . $_REQUEST["telephone_no1"] . "','" . $_REQUEST["mobile_no1"] . "','" . $_REQUEST["email_id1"] . "','" . $_REQUEST["contact_person_name2"] . "','" . $_REQUEST["telephone_no2"] . "','" . $_REQUEST["mobile_no2"] . "','" . $_REQUEST["email_id2"] . "','" . $_REQUEST["contact_person_name3"] . "','" . $_REQUEST["telephone_no3"] . "','" . $_REQUEST["mobile_no3"] . "','" . $_REQUEST["email_id3"] . "','Branch','0')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set client_name='" . $_REQUEST["client_name"] . "',division_name='" . $_REQUEST["division_name"] . "',branch_name='" . $_REQUEST["branch_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',telephone_no='" . $_REQUEST["telephone_no"] . "',mobile_no='" . $_REQUEST["mobile_no"] . "',fax_no='" . $_REQUEST["fax_no"] . "',email_id='" . $_REQUEST["email_id"] . "',tin_no='" . $_REQUEST["tin_no"] . "',cst_no='" . $_REQUEST["cst_no"] . "',contact_person_name1='" . $_REQUEST["contact_person_name1"] . "',telephone_no1='" . $_REQUEST["telephone_no1"] . "',mobile_no1='" . $_REQUEST["mobile_no1"] . "',email_id1='" . $_REQUEST["email_id1"] . "',contact_person_name2='" . $_REQUEST["contact_person_name2"] . "',telephone_no2='" . $_REQUEST["telephone_no2"] . "',mobile_no2='" . $_REQUEST["mobile_no2"] . "',email_id2='" . $_REQUEST["email_id2"] . "',contact_person_name3='" . $_REQUEST["contact_person_name3"] . "',telephone_no3='" . $_REQUEST["telephone_no3"] . "',mobile_no3='" . $_REQUEST["mobile_no3"] . "',email_id3='" . $_REQUEST["email_id3"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>