<?php

if ($_SESSION['user_database'] == "Default") {
    $Query = "select database_name from master_financialyear order by id desc";
    $DB->query($Query);
    if ($DB->Multicoloums()) {
        $database_name = $DB->Record["database_name"];
    }
} else {
    $database_name = $_SESSION["user_database"];
}
define("USERDATABASE", $database_name);

include '../../class/user_database.inc.php';
$UDB = new Userdatabase;
$UDB1 = new Userdatabase;
?>