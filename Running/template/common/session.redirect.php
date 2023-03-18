<?php

ob_start();
session_start();

$msg = "Please login to access!";
$errorpage = '../common/signin.php';

if ($_SESSION['username'] == NULL) {
    $FN->page_redirect_msg($errorpage, $msg);
}
?>