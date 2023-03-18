<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_frieght_bill_item';
$order_no = $_REQUEST["order_no"];
$mr_type = $_REQUEST["mr_type"];

/* $Query1 = "select count(bill_no) as count_bill from $tablename where bill_no='" . $order_no . "' and pending_amount>0";
  $UDB1->query($Query1);
  while ($UDB1->Multicoloums()) {
  $count_bill = $UDB1->Record["count_bill"];
  } */
if ($mr_type == "Freight Bill") {
    $Query = "select distinct(no_item),bill_date_item,pending_amount from $tablename where bill_no='" . $order_no . "' and pending_amount>0";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $str = $str . "\"" . $UDB->Record["no_item"] . "\"" . ",";
        //  $str = $str . "\"" . $UDB->Record["bill_date_item"] . "\"" . ",";
        //$str = $str . "\"" . $UDB->Record["pending_amount"] . "\"" . ",";
        //$str = $str . "\"" . $count_bill . "\"" . ",";
    }
} else if ($mr_type == "Order No") {
    $Query = "select distinct(no_item),bill_date_item,pending_amount from $tablename where no_item='" . $order_no . "' and pending_amount>0";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $str = $str . "\"" . $UDB->Record["no_item"] . "\"" . ",";
    }
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>