<?php

ob_start();
session_start();


include'../../template/common/header.config.php';
include'../../template/common/system_expire_status.php';
$superadmin_redirectpage = '../superadmin/dashboard.php';
$accounts_redirectpage = '../accounts/dashboard.php';
$operation_redirectpage = '../operation/dashboard.php';
$client_redirectpage = '../client/dashboard.php';
$client_branch_redirectpage = '../client_branch/dashboard.php';
$client_division_redirectpage = '../client_division/dashboard.php';
$expirationpage = 'account_expire.php';
$expirationmessage = 'Demo Expired';
$errorpage = 'signin.php';
$msg = "Username or Password Mismatch";
$tablename = sr_user;
$usertype = NULL;

$_SESSION['user_database'] = $_REQUEST["user_database"];
$Query = "SELECT usertype,registered_at,division,branch,division1,branch1,division2,branch2  from $tablename where username='" . strtolower($_REQUEST["username"]) . "' and password='" . $_REQUEST["password"] . "' and active_status='Active'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $usertype = $DB->Record["usertype"];
    $registered_at = $DB->Record["registered_at"];
    $division = $DB->Record["division"];
    $division1 = $DB->Record["division1"];
    $division2 = $DB->Record["division2"];
    $branch = $DB->Record["branch"];
    $branch1 = $DB->Record["branch1"];
    $branch2 = $DB->Record["branch2"];
}
$_SESSION['username'] = $_REQUEST["username"];
$_SESSION['registered_at'] = $registered_at;
if ($_REQUEST["database_name"] != NULL) {
    $_SESSION['user_database'] = $_REQUEST["database_name"];
} else {
    $_SESSION['user_database'] = "Default";
}
if ($usertype == NULL) {
    $FN->page_redirect_msg($errorpage, $msg);
} else if ($usertype == "Super Administrator") {
    $_SESSION['usertype'] = "Super Administrator";
    if ($systemexpire_demoexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else if ($systemexpire_liveexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else {
        $FN->page_redirect($superadmin_redirectpage);
    }
} else if ($usertype == "Accounts") {
    $_SESSION['usertype'] = "Accounts";
    if ($systemexpire_demoexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else if ($systemexpire_liveexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else {
        $FN->page_redirect($accounts_redirectpage);
    }
} else if ($usertype == "Operation") {
    $_SESSION['usertype'] = "Operation";
    if ($systemexpire_demoexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else if ($systemexpire_liveexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else {
        $FN->page_redirect($operation_redirectpage);
    }
} else if ($usertype == "Client Admin") {
    $_SESSION['usertype'] = "Client Admin";
    $_SESSION['division'] = $division;
    if ($systemexpire_demoexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else if ($systemexpire_liveexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else {
        $FN->page_redirect($client_redirectpage);
    }
} else if ($usertype == "Client Division") {
    $_SESSION['usertype'] = "Client Division";
    $_SESSION['division'] = $division;
    $_SESSION['division1'] = $division1;
    $_SESSION['division2'] = $division2;
    if ($systemexpire_demoexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else if ($systemexpire_liveexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else {
        $FN->page_redirect($client_division_redirectpage);
    }
} else if ($usertype == "Client Branch") {
    $_SESSION['usertype'] = "Client Branch";
    $_SESSION['branch'] = $branch;
    $_SESSION['branch1'] = $branch1;
    $_SESSION['branch2'] = $branch2;
    if ($systemexpire_demoexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else if ($systemexpire_liveexpire_status == True) {
        $FN->page_redirect($expirationpage);
    } else {
        $FN->page_redirect($client_branch_redirectpage);
    }
}
?>