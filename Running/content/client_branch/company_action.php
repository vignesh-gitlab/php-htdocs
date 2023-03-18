<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_company';
$return_page = 'company_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'','','','" . $_REQUEST["company_name"] . "','" . $_REQUEST["company_caption"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["telephone_no"] . "','" . $_REQUEST["mobile_no"] . "','" . $_REQUEST["fax_no"] . "','" . $_REQUEST["email_id"] . "','" . $_REQUEST["website_id"] . "','" . $_REQUEST["tin_no"] . "','" . $_REQUEST["cst_no"] . "','Head Office')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set company_name='" . $_REQUEST["company_name"] . "',company_caption='" . $_REQUEST["company_caption"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',telephone_no='" . $_REQUEST["telephone_no"] . "',mobile_no='" . $_REQUEST["mobile_no"] . "',fax_no='" . $_REQUEST["fax_no"] . "',email_id='" . $_REQUEST["email_id"] . "',website_id='" . $_REQUEST["website_id"] . "',tin_no='" . $_REQUEST["tin_no"] . "',cst_no='" . $_REQUEST["cst_no"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>