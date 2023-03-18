<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user';
$return_page = 'user_creation_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["user_id"] . "','" . $_REQUEST["usertype"] . "','" . $_REQUEST["display_name"] . "','" . $_REQUEST["username"] . "','" . $_REQUEST["password"] . "','" . $_REQUEST["division"] . "','" . $_REQUEST["branch"] . "','" . $_REQUEST["division1"] . "','" . $_REQUEST["branch1"] . "','" . $_REQUEST["division2"] . "','" . $_REQUEST["branch2"] . "','" . $registered_at . "','','Active')";
    $DB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set usertype='" . $_REQUEST["usertype"] . "',display_name='" . $_REQUEST["display_name"] . "',username='" . $_REQUEST["username"] . "',password='" . $_REQUEST["password"] . "' where id=" . $_REQUEST["id"];
    $DB->query($Query);
}
$FN->page_redirect($return_page);
?>