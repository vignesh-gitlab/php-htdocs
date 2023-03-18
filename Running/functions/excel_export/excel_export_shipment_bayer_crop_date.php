<?php

require("../../template/common/header.config.php");
require("../../template/common/userdb_cofiguration.php");

$filename = "Export.xls";
ob_start();
session_start();
$user_database = $_SESSION['user_database'];

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");

session_cache_limiter("must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="' . $filename . '"');

if (!mysql_connect(HOSTNAME, USERNAME, PASSWORD))
    die("Can't connect to database");
if (!mysql_select_db($user_database))
    die("Can't select database");

error_reporting(0);

$condition = "client_name='Bayer Crop Science'";
$from_date_val = explode("-", $_REQUEST["from_date"]);
$from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
$to_date_val = explode("-", $_REQUEST["to_date"]);
$to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0];
/* $from_date_val = explode("-", "01-06-2015");
  $from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
  $to_date_val = explode("-", "30-07-2015");
  $to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0]; */

$final_data .= 'S NO' . "\t" . '"ORDER NUMBER"' . "\t" . '"LR NO"' . "\t" . '"DATE OF  LOADING "' . "\t" . '"PKG"' . "\t" . '"TOTAL WT DURING LOADING (NET)"' . "\t" . '"CHARGED WEIGHT GROSS"' . "\t" . '"TYPE OF VEHICLE"' . "\t" . '"VEHICLE NO."' . "\t" . '"FROM (LOCATION)"' . "\t" . '"TO (LOCATION)"' . "\t" . '"REPORTING DATE"' . "\t" . '"AGREED TRANSIT DAYS"' . "\t" . '"ACTUAL TRANSIT DAYS"' . "\t" . '"CURRENT STATUS"' . "\t" . '"REMARKS"' . "\t" . '"DRIVER CONTACT"' . "\n";
//$final_data ="";

$sno = 0;

$Query = "SELECT order_no,orgin,destination,vehicle_type FROM sr_customer_order WHERE STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND " . $condition;
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $sno = $sno + 1;
    $order_no = $UDB->Record["order_no"];
    $orgin = $UDB->Record["orgin"];
    $destination = $UDB->Record["destination"];
    $vehicle_type = $UDB->Record["vehicle_type"];

    $driver_contact_no = "";

    $Query1 = "SELECT driver_contact_no FROM sr_vehicle_booking WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $driver_contact_no = $UDB1->Record["driver_contact_no"];
    }

    $vehicle_no = "";
    $weight = "";
    $lr_no = "";
    $dispatch_date = "";
    $loading_end_date = "";
    $no_of_pack = "";
    $weight = "";

    $Query1 = "SELECT vehicle_no,weight,lr_no,dispatch_date,loading_end_date,invoice_no,no_of_pack,weight FROM sr_vehicle_dispatch WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $vehicle_no = $UDB1->Record["vehicle_no"];
        $weight = $UDB1->Record["weight"];
        $lr_no = $UDB1->Record["lr_no"];
        $dispatch_date = $UDB1->Record["dispatch_date"];
        $loading_end_date = $UDB1->Record["loading_end_date"];
        $no_of_pack = $UDB1->Record["no_of_pack"];
        $weight = $UDB1->Record["weight"];
    }

    $unloading_date = "";
    $vehicle_release_date = "";
    $remarks = "";

    $Query1 = "SELECT unloading_date,vehicle_release_date,remarks FROM sr_vehicle_reporting WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $unloading_date = $UDB1->Record["unloading_date"];
        $vehicle_release_date = $UDB1->Record["vehicle_release_date"];
        $remarks = $UDB1->Record["remarks"];
    }

    $landing_date = "";
    $current_status = "On Progress";

    $Query1 = "SELECT landing_date FROM sr_vehicle_landing WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $landing_date = $UDB1->Record["landing_date"];
        $current_status = "Delivered";
    }

    $delay_reason = "";

    $Query1 = "SELECT delay_reason FROM sr_vehicle_status WHERE order_no='" . $order_no . "' and delay_reason<>''";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $delay_reason = $UDB1->Record["delay_reason"];
    }

    if (isset($landing_date) && !empty($landing_date)) {
        $datetime1 = new DateTime($expected_dateof_delivery);
        $datetime2 = new DateTime($dispatch_date);
        $interval = $datetime1->diff($datetime2);
        $ontime_landing_time = $interval->format('%R%d days');
        $agreed_tat = $interval->format('%d Days');
        //echo $ontime_landing_time;

        if ($ontime_landing_time <= 0) {
            $ontime_landing_status = "Yes";
            $hit_miss_status = "Hit";
        } else {
            $ontime_landing_status = "No";
            $hit_miss_status = "Miss";
        }

        //echo $dispatch_date."-".$landing_date."<br>";
        $datetime1 = new DateTime($dispatch_date);
        $datetime2 = new DateTime($landing_date);
        $interval = $datetime1->diff($datetime2);
        $actual_tat = $interval->format('%d Days');
    } else {
        $hit_miss_status = "On Transit";
        $ontime_landing_status = "";
        $actual_tat = "";
    }

    $current_vehicle_status = "";
    if ($hit_miss_status == "On Transit") {
        $current_vehicle_status = "In Transit";
    } else {
        $current_vehicle_status = "Delivered";
    }

    $final_data .= '"' . $sno . '"' . "\t" . '"' . $order_no . '"' . "\t" . '"' . $lr_no . '"' . "\t" . '"' . $loading_end_date . '"' . "\t" . '"' . $no_of_pack . '"' . "\t" . '"' . $weight . '"' . "\t" . '" "' . "\t" . '"' . $vehicle_type . '"' . "\t" . '"' . $vehicle_no . '"' . "\t" . '"' . $orgin . '"' . "\t" . '"' . $destination . '"' . "\t" . '"' . $landing_date . '"' . "\t" . '"' . $agreed_tat . '"' . "\t" . '"' . $actual_tat . '"' . "\t" . '"' . $current_vehicle_status . '"' . "\t" . '"' . $delay_reason . '"' . "\t" . '"' . $driver_contact_no . '"' . "\n";
}
print "$final_data";
?>