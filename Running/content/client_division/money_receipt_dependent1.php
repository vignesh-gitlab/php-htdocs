<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_frieght_bill';
$client_name = $_REQUEST["client_name"];
$mr_type = $_REQUEST["mr_type"];

if ($mr_type == "Freight Bill") {
    $Query = "select bill_no from $tablename where client_name='" . $client_name . "' and total_pending_amount>0";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $str = $str . "\"" . $UDB->Record["bill_no"] . "\"" . ",";
        //$bill_no = $UDB->Record["bill_no"];
        /*  $Query1 = "select distinct(bill_no) from sr_frieght_bill_item where bill_no='" . $bill_no . "' and pending_amount>0";
          $UDB1->query($Query1);
          while ($UDB1->Multicoloums()) {
          $str = $str . "\"" . $UDB1->Record["bill_no"] . "\"" . ",";
          //$no_item=$UDB->Record["no_item"];
          } */
    }
} else if ($mr_type == "Order No") {
    $Query = "select stationary_no,order_no from sr_bilty where consignor_name='" . $client_name . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        //$str = $str . "\"" . $UDB->Record["order_no"] . "\"" . ",";
        $stationary_no = $UDB->Record["stationary_no"];
        //$order_no = $UDB->Record["order_no"];

        $Query1 = "select distinct(no_item) from sr_frieght_bill_item where no_item='" . $stationary_no . "' and pending_amount>0";
        $UDB1->query($Query1);
        while ($UDB1->Multicoloums()) {
            //$str = $str . "\"" . $UDB1->Record["no_item"] . "\"" . ",";
            $no_item = $UDB1->Record["no_item"];

            $Query1 = "select order_no from sr_bilty where stationary_no='" . $no_item . "'";
            $UDB1->query($Query1);
            while ($UDB1->Multicoloums()) {
                $str = $str . "\"" . $UDB1->Record["order_no"] . "\"" . ",";
            }
        }
    }
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>