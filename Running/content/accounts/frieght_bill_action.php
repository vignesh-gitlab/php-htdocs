<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_frieght_bill';
$tablename1 = 'sr_frieght_bill_item';
$return_page = 'frieght_bill_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["branch_code"] . "','" . $_REQUEST["branch"] . "','" . $_REQUEST["stationary_no"] . "','" . $_REQUEST["service_tax_payable_by"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["division_name"] . "','" . $_REQUEST["branch_name"] . "','" . $_REQUEST["party_address_line1"] . "','" . $_REQUEST["party_address_line2"] . "','" . $_REQUEST["party_city"] . "','" . $_REQUEST["party_pincode"] . "','" . $_REQUEST["bill_no"] . "','" . $_REQUEST["bill_date"] . "','" . $_REQUEST["credit_days"] . "','" . $_REQUEST["pan_no"] . "','" . $_REQUEST["total"] . "','0','" . $_REQUEST["total"] . "','','Open')";
    $UDB->query($Query);

    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["no_item" . $i] != "Select" || (isset($_REQUEST["from_to" . $i]) && !empty($_REQUEST["from_to" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["bill_no"] . "','" . $_REQUEST["bill_date_item" . $i] . "','" . $_REQUEST["no_item" . $i] . "','" . $_REQUEST["particular" . $i] . "','" . $_REQUEST["from_to" . $i] . "','" . $_REQUEST["weight" . $i] . "','" . $_REQUEST["rate" . $i] . "','" . $_REQUEST["rate_type" . $i] . "','0','" . $_REQUEST["sub_total" . $i] . "','" . $_REQUEST["sub_total" . $i] . "')";
            $UDB->query($Query);

            $Query1 = "update sr_bilty set bilty_status='Released' where stationary_no='" . $_REQUEST["no_item" . $i] . "'";
            $UDB1->query($Query1);
        }
    }
} else if ($_REQUEST["form_action1"] == "date_of_receiving") {
    $Query = "insert into sr_date_of_receiving values(NULL,'" . $_REQUEST["bill_no"] . "','" . $_REQUEST["date_of_receiving"] . "')";
    $UDB->query($Query);
} else if ($_REQUEST["approval"] == "Approve") {

    $Query = "update $tablename set frieght_status='Approval' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
} else if ($_REQUEST["form_action"] == "Update") {

    $Query = "update $tablename set branch_code='" . $_REQUEST["branch_code"] . "', branch='" . $_REQUEST["branch"] . "',stationary_no='" . $_REQUEST["stationary_no"] . "',service_tax_payable_by='" . $_REQUEST["service_tax_payable_by"] . "',client_name='" . $_REQUEST["client_name"] . "',division_name='" . $_REQUEST["division_name"] . "',branch_name='" . $_REQUEST["branch_name"] . "',party_address_line1='" . $_REQUEST["party_address_line1"] . "',party_address_line2='" . $_REQUEST["party_address_line2"] . "',party_city='" . $_REQUEST["party_city"] . "',party_pincode='" . $_REQUEST["party_pincode"] . "',bill_no='" . $_REQUEST["bill_no"] . "',bill_date='" . $_REQUEST["bill_date"] . "',credit_days='" . $_REQUEST["credit_days"] . "',pan_no='" . $_REQUEST["pan_no"] . "',total='" . $_REQUEST["total"] . "',total_pending_amount='" . $_REQUEST["total"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);

    $Query = "delete from $tablename1 where bill_no='" . $_REQUEST["bill_no"] . "'";
    $UDB->query($Query);
    for ($i = 1; $i <= $_REQUEST["product_count"]; $i++) {
        if ($_REQUEST["no_item" . $i] != "Select" || (isset($_REQUEST["from_to" . $i]) && !empty($_REQUEST["from_to" . $i]))) {
            $Query = "insert into $tablename1 values(NULL,'" . $_REQUEST["bill_no"] . "','" . $_REQUEST["bill_date_item" . $i] . "','" . $_REQUEST["no_item" . $i] . "','" . $_REQUEST["particular" . $i] . "','" . $_REQUEST["from_to" . $i] . "','" . $_REQUEST["weight" . $i] . "','" . $_REQUEST["rate" . $i] . "','" . $_REQUEST["rate_type" . $i] . "','0','" . $_REQUEST["sub_total" . $i] . "','" . $_REQUEST["sub_total" . $i] . "')";
            $UDB->query($Query);
        }
    }
} /* elseif ($_REQUEST["form_action"] == "date_of_receiving") {
  $Query = "insert into sr_date_of_receiving values(NULL,'" . $_REQUEST["bill_no"] . "','" . $_REQUEST["date_of_receiving"] . "')";
  $UDB->query($Query);
  } */ else if ($_REQUEST["form_action"] == "Delete") {

    $Query = "delete from $tablename where bill_no='" . $_REQUEST["bill_no"] . "'";
    $UDB->query($Query);
    $Query = "delete from $tablename1 where bill_no='" . $_REQUEST["bill_no"] . "'";
    $UDB->query($Query);
}
$FN->page_redirect($return_page);
?>