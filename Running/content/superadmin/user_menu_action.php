<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_user_menu';
$return_page = 'user_creation_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "SELECT distinct(menu_name) from sr_menu";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $menu_name = $DB->Record["menu_name"];
        $Query1 = "SELECT page_name from sr_menu where menu_name='" . $menu_name . "'";
        $DB1->query($Query1);
        while ($DB1->Multicoloums()) {
            $page_name = $DB1->Record["page_name"];
            $check_pagename = strtolower(str_replace(" ", "_", $page_name));

            if (isset($_REQUEST[$check_pagename]) && !empty($_REQUEST[$check_pagename])) {
                $Query2 = "insert into $tablename values(NULL,'" . $_REQUEST["usertype"] . "','" . $_REQUEST["username"] . "','" . $menu_name . "','" . $_REQUEST[$check_pagename] . "')";
                $DB2->query($Query2);
            }
        }
    }
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "delete from $tablename where username='" . $_REQUEST["username"] . "'";
    $DB->query($Query);
    $Query = "SELECT distinct(menu_name) from sr_menu";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $menu_name = $DB->Record["menu_name"];
        $Query1 = "SELECT page_name from sr_menu where menu_name='" . $menu_name . "'";
        $DB1->query($Query1);
        while ($DB1->Multicoloums()) {
            $page_name = $DB1->Record["page_name"];
            $check_pagename = strtolower(str_replace(" ", "_", $page_name));

            if (isset($_REQUEST[$check_pagename]) && !empty($_REQUEST[$check_pagename])) {
                $Query2 = "insert into $tablename values(NULL,'" . $_REQUEST["usertype"] . "','" . $_REQUEST["username"] . "','" . $menu_name . "','" . $_REQUEST[$check_pagename] . "')";
                $DB2->query($Query2);
            }
        }
    }
}
$FN->page_redirect($return_page);
?>