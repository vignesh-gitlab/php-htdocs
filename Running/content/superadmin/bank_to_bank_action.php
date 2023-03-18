<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_bank_to_bank';
$return_page = 'bank_to_bank_grid.php';
$registered_at = $FN->return_date_time();
if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["hd_code"] . "','" . $_REQUEST["hd_name"] . "','" . $_REQUEST["hd_bank_name"] . "','" . $_REQUEST["hd_bank_branch"] . "','" . $_REQUEST["hd_ac_no"] . "','" . $_REQUEST["payment_no"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["bank_branch"] . "','" . $_REQUEST["ac_no"] . "','" . $_REQUEST["amount"] . "','" . $_REQUEST["description"] . "','" . $_REQUEST["payment_mode"] . "')";
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set hd_code='" . $_REQUEST["hd_code"] . "', hd_name='" . $_REQUEST["hd_name"] . "',hd_bank_name='" . $_REQUEST["hd_bank_name"] . "',hd_bank_branch='" . $_REQUEST["hd_bank_branch"] . "',hd_ac_no='" . $_REQUEST["hd_ac_no"] . "',payment_no='" . $_REQUEST["payment_no"] . "',branch_code='" . $_REQUEST["branch_code"] . "',branch_name='" . $_REQUEST["branch_name"] . "',bank_name='" . $_REQUEST["bank_name"] . "',bank_branch='" . $_REQUEST["bank_branch"] . "',ac_no='" . $_REQUEST["ac_no"] . "',amount='" . $_REQUEST["amount"] . "',description='" . $_REQUEST["description"] . "',payment_mode='" . $_REQUEST["payment_mode"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>