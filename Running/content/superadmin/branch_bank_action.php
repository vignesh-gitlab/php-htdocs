<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_branch_bank';
$return_page = 'branch_bank_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["branch_code"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["bank_branch"] . "','" . $_REQUEST["ac_no"] . "','" . $_REQUEST["ac_name"] . "','" . $_REQUEST["account_type"] . "','" . $_REQUEST["ifsc_code"] . "','" . $_REQUEST["minimum_balance"] . "','" . $_REQUEST["account_balance"] . "')";
    $DB->query($Query);
} else
if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set branch_code='" . $_REQUEST["branch_code"] . "', bank_name='" . $_REQUEST["bank_name"] . "',bank_branch='" . $_REQUEST["bank_branch"] . "',ac_no='" . $_REQUEST["ac_no"] . "',ac_name='" . $_REQUEST["ac_name"] . "',ac_type='" . $_REQUEST["account_type"] . "',ifsc_code='" . $_REQUEST["ifsc_code"] . "',minimum_balance='" . $_REQUEST["minimum_balance"] . "',account_balance='" . $_REQUEST["account_balance"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>