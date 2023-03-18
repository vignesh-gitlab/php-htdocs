<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_advertisement';
$return_page = 'advertisement_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $target_dir = "../../files/uploads/others/";
    $filename = basename($_FILES["ad_copy"]["name"]);
    $target_file = $target_dir . $filename;
    move_uploaded_file($_FILES['ad_copy']['tmp_name'], $target_file);

    $Query = "SELECT max(cast(advertisement_id as unsigned))as max_id from $tablename";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
    $new_max_orderno = $commonvar_payment_no_prefix . $new_max_id;
    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["description"] . "','" . $_REQUEST["amount"] . "','" . $filename . "','Open')";
    $UDB->query($Query);
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set ad_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {
    $target_dir = "../../files/uploads/others/";
    $filename = basename($_FILES["ad_copy"]["name"]);
    $target_file = $target_dir . $filename;
    move_uploaded_file($_FILES['ad_copy']['tmp_name'], $target_file);

    if ($filename == NULL) {
        $Query = "update $tablename set description = '" . $_REQUEST["description"] . "', amount = '" . $_REQUEST["amount"] . "' where id = " . $_REQUEST["id"];
        $UDB->query($Query);
    } else {
        $Query = "update $tablename set description = '" . $_REQUEST["description"] . "', amount = '" . $_REQUEST["amount"] . "', ad_copy = '" . $filename . "' where id = " . $_REQUEST["id"];
        $UDB->query($Query);
    }
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>