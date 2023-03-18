<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_bill_despatch_advice';
$tablename1 = 'sr_bill_despatch_advice_item';
$return_page = 'bill_despatch_advice_report.php';
$registered_at = $FN->return_date_time();

$Query = "SELECT max(cast(da_id as unsigned))as max_id from $tablename";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $max_id = $UDB->Record["max_id"];
}
$new_max_id = $max_id + 1;
$new_max_orderno = $commonvar_despatch_advice_no_prefix . $new_max_id;


if ($_REQUEST["form_action"] == "Insert") {
    // $Query = "delete from $tablename where client_name='" . $_REQUEST["client_name"] . "'";
    //$UDB->query($Query);
    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["da_date"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["ac_no"] . "','" . $_REQUEST["total"] . "')";
    $UDB->query($Query);
    for ($i = 1; $i <= 100; $i++) {
        $Query = "delete from $tablename1 where bill_no='" . $_REQUEST["bill_no" . $i] . "'";
        $UDB->query($Query);
    }
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {

        if ($_REQUEST["bill_no" . $i] != "Select" || (isset($_REQUEST["bill_date" . $i]) && !empty($_REQUEST["bill_date" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["da_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["bill_no" . $i] . "','" . $_REQUEST["bill_date" . $i] . "','" . $_REQUEST["bill_amount" . $i] . "','" . $_REQUEST["da_date"] . "')";
            $UDB->query($Query);
            $Query1 = "update sr_frieght_bill set sub_date='" . $_REQUEST["da_date"] . "' where bill_no='" . $_REQUEST["bill_no" . $i] . "'";
            $UDB1->query($Query1);
        }
    }
} else if ($_REQUEST["form_action"] == "Update") {
    // $Query = "delete from $tablename where client_name='" . $_REQUEST["client_name"] . "'";
    //$UDB->query($Query);
    $Query = "insert into $tablename values(NULL,'" . $new_max_id . "','" . $new_max_orderno . "','" . $_REQUEST["da_date"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["bank_name"] . "','" . $_REQUEST["ac_no"] . "','" . $_REQUEST["total"] . "')";
    $UDB->query($Query);
    for ($i = 1; $i <= 100; $i++) {
        $Query = "delete from $tablename1 where bill_no='" . $_REQUEST["bill_no" . $i] . "'";
        $UDB->query($Query);
    }
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["bill_no" . $i] != "Select" || (isset($_REQUEST["bill_date" . $i]) && !empty($_REQUEST["bill_date" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["da_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["bill_no" . $i] . "','" . $_REQUEST["bill_date" . $i] . "','" . $_REQUEST["bill_amount" . $i] . "','" . $_REQUEST["da_date"] . "')";
            $UDB->query($Query);
            $Query1 = "update sr_frieght_bill set sub_date='" . $_REQUEST["da_date"] . "' where bill_no='" . $_REQUEST["bill_no" . $i] . "'";
            $UDB1->query($Query1);
        }
    }

    /* $Query = "update $tablename set da_date='" . $_REQUEST["da_date"] . "',client_name='" . $_REQUEST["client_name"] . "',branch_code='" . $_REQUEST["branch_code"] . "',branch_name='" . $_REQUEST["branch_name"] . "',bank_name='" . $_REQUEST["bank_name"] . "',ac_no='" . $_REQUEST["ac_no"] . "' where id=" . $_REQUEST["id"];
      $UDB->query($Query);

      $Query = "delete from $tablename1 where da_no='" . $_REQUEST["da_no"] . "'";
      $UDB->query($Query);
      for ($i = 1; $i <= $_REQUEST["product_coun t"]; $i++) {
      if ($_R EQUEST["bill_no" . $i] != "" || (isset($_REQUEST["bill_date" . $i]) && !empty($_REQUEST["bill_date" . $i]))) {
      $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["da_no"] . "','" . $_REQUEST["bill_no" . $i] . "','" . $_REQUEST["bill_date" . $i] . "','" . $_REQUEST["total" . $i] . "','" . $_REQUEST["da_date" . $i] . "')";
      $UDB->query($Query);
      }
      } */
} else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where da_no='" . $_REQUEST["da_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where da_no='" . $_REQUEST["da_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>