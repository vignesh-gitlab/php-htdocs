<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_employee';
$return_page = 'employee_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "SELECT max(cast(employee_id as unsigned))as max_id from $tablename";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $max_id = $DB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_employee_no_prefix . $new_max_id;
    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["employee_name"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["address_line1"] . "','" . $_REQUEST["address_line2"] . "','" . $_REQUEST["city"] . "','" . $_REQUEST["pincode"] . "','" . $_REQUEST["telephone_number"] . "','" . $_REQUEST["mobile_number"] . "','" . $_REQUEST["email_id"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["bank_branch"] . "','" . $_REQUEST["ac_no"] . "','" . $_REQUEST["ac_name"] . "','" . $_REQUEST["account_type"] . "','" . $_REQUEST["ifsc_code"] . "')";
    $DB->query($Query);
} else
if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set employee_name='" . $_REQUEST["employee_name"] . "', branch_code='" . $_REQUEST["branch_code"] . "',branch_name='" . $_REQUEST["branch_name"] . "',address_line1='" . $_REQUEST["address_line1"] . "',address_line2='" . $_REQUEST["address_line2"] . "',city='" . $_REQUEST["city"] . "',pincode='" . $_REQUEST["pincode"] . "',telephone_number='" . $_REQUEST["telephone_number"] . "',mobile_number='" . $_REQUEST["mobile_number"] . "',email_id='" . $_REQUEST["email_id"] . "', bank_name='" . $_REQUEST["bank_name"] . "',bank_branch='" . $_REQUEST["bank_branch"] . "',ac_no='" . $_REQUEST["ac_no"] . "',ac_name='" . $_REQUEST["ac_name"] . "',ac_type='" . $_REQUEST["account_type"] . "',ifsc_code='" . $_REQUEST["ifsc_code"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>