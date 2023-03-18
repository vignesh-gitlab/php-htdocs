<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user';
$return_page = '../common/signin.php';
$error_page = '../operation/change_password.php';
$msg = "Please Enter Correct Old Password!";
$success_msg = 'Password Changed Successfully!';
$registered_at = $FN->return_date_time();

$Query = "SELECT password from $tablename where username='" . $_REQUEST["username"] . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $password = $DB->Record["password"];
}

if ($password == $_REQUEST["password"]) {
    $Query = "update $tablename set password='" . $_REQUEST["new_password"] . "' where username='" . $_REQUEST["username"] . "'";
    $DB->query($Query);
    $FN->page_redirect_msg($return_page, $success_msg);
} else {
    echo"False";
    $FN->page_redirect_msg($error_page, $msg);
}
?>