<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_stationary';
$return_page = 'stationary_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["book_type"] . "','" . $_REQUEST["from_no"] . "','" . $_REQUEST["to_no"] . "')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set book_type='" . $_REQUEST["book_type"] . "',from_no='" . $_REQUEST["from_no"] . "',to_no='" . $_REQUEST["to_no"] . "',branch_name='" . $_REQUEST["branch_name"] . "',branch_code='" . $_REQUEST["branch_code"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>