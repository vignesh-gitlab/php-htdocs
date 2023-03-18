<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_supervisor';
$return_page = 'supervisor_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    if ($_FILES["reference_documents"]["error"] > 0) {
        echo "Return Code: " . $_FILES["reference_documents"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["reference_documents"]["tmp_name"], "../../files/Supervisor/" . $_FILES["reference_documents"]["name"]);
    }
    $filename = $_FILES["reference_documents"]["name"];
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["supervisor_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["contact_no1"] . "','" . $_REQUEST["contact_no2"] . "','" . $_REQUEST["email_id"] . "','" . $_REQUEST["date_of_join"] . "','" . $filename . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["bank_branch"] . "','" . $_REQUEST["ac_no"] . "','" . $_REQUEST["ac_name"] . "','" . $_REQUEST["account_type"] . "','" . $_REQUEST["ifsc_code"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set supervisor_name='" . $_REQUEST["supervisor_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',contact_no1='" . $_REQUEST["contact_no1"] . "',contact_no2='" . $_REQUEST["contact_no2"] . "',email_id='" . $_REQUEST["email_id"] . "',date_of_join='" . $_REQUEST["date_of_join"] . "',bank_name='" . $_REQUEST["bank_name"] . "',bank_branch='" . $_REQUEST["bank_branch"] . "',ac_no='" . $_REQUEST["ac_no"] . "',ac_name='" . $_REQUEST["ac_name"] . "',ac_type='" . $_REQUEST["account_type"] . "',ifsc_code='" . $_REQUEST["ifsc_code"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>