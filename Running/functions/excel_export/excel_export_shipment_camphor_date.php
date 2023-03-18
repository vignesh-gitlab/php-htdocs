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

$condition = "client_name='Camphor & Allied Products Ltd.'";
$from_date_val = explode("-", $_REQUEST["from_date"]);
$from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
$to_date_val = explode("-", $_REQUEST["to_date"]);
$to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0];
/* $from_date_val = explode("-", "01-06-2015");
  $from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
  $to_date_val = explode("-", "30-07-2015");
  $to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0]; */

$final_data .= 'S NO' . "\t" . '"ORDER NUMBER"' . "\t" . '"EMPTY PICKUP DATE"' . "\t" . '"STUFFING DATE"' . "\t" . '"ACTUAL STUFFING DATE"' . "\t" . '"ORDER DATE"' . "\t" . '"ORDER TIME"' . "\t" . '"VEHICLE REQUIRED DATE"' . "\t" . '"VEHICLE REQUIRED TIME"' . "\t" . '"VEHICLE PLACEMENT DATE"' . "\t" . '"VEHICLE PLACEMENT TIME"' . "\t" . '"FROM"' . "\t" . '"TO"' . "\t" . '"CARGO TYPE"' . "\t" . '"VEHICLE NO."' . "\t" . '"CARGO WEIGHTT"' . "\t" . '"LR NO."' . "\t" . '"CONT./ TANK NO."' . "\t" . '"OFFLOADING DATE"' . "\t" . '"ESCORT"' . "\t" . '"AGREED TRANSIT TIME"' . "\t" . '"ACTUAL TRANSIT TIME"' . "\t" . '"HIT / MISS"' . "\t" . '"REASON FOR LATE REPORTING OF THE VEHICLE"' . "\t" . '"DRIVER CONTACT"' . "\n";
//$final_data ="";

$sno = 0;

$Query = "SELECT order_no,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_ownership_type FROM sr_customer_order WHERE STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND " . $condition;
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    $sno = $sno + 1;
    $order_no = $UDB->Record["order_no"];
    $order_date = $UDB->Record["order_date"];
    $order_time = $UDB->Record["order_time"];
    $vehicle_required_date = $UDB->Record["vehicle_required_date"];
    $vehicle_required_time = $UDB->Record["vehicle_required_time"];
    $orgin = $UDB->Record["orgin"];
    $destination = $UDB->Record["destination"];
    $vehicle_type = $UDB->Record["vehicle_type"];
    $vehicle_ownership_type = $UDB->Record["vehicle_ownership_type"];
    if ($vehicle_ownership_type == "Contract Vehicle") {
        $vehicle_ownership = "Contractual";
    } else {
        $vehicle_ownership = "Non Contractual";
    }

    $driver_type = "";
    $driver_contact_no = "";
    $escart_option = "";
    $loading_charges = "";
    $unloading_charges = "";

    $Query1 = "SELECT driver_type,driver_contact_no,escart_option,loading_charges,unloading_charges FROM sr_vehicle_booking WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $driver_type = $UDB1->Record["driver_type"];
        if ($driver_type == "Double") {
            $double_driver = "Yes";
        } else {
            $double_driver = "No";
        }
        $driver_contact_no = $UDB1->Record["driver_contact_no"];
        $escart_option = $UDB1->Record["escart_option"];
        $loading_charges = $UDB1->Record["loading_charges"];
        $unloading_charges = $UDB1->Record["unloading_charges"];
    }

    $vehicle_no = "";
    $weight = "";
    $expected_dateof_delivery = "";
    $lr_no = "";
    $lr_date = "";
    $dispatch_date = "";
    $loading_end_date = "";
    $invoice_no = "";
    $no_of_pack = "";
    $weight = "";
    $placement_date = "";
    $placement_time = "";

    $Query1 = "SELECT vehicle_no,weight,expected_dateof_delivery,lr_no,lr_date,dispatch_date,loading_end_date,invoice_no,no_of_pack,weight,placement_date,loading_start_date,placement_time FROM sr_vehicle_dispatch WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $vehicle_no = $UDB1->Record["vehicle_no"];
        $weight = $UDB1->Record["weight"];
        $expected_dateof_delivery = $UDB1->Record["expected_dateof_delivery"];
        $lr_no = $UDB1->Record["lr_no"];
        $lr_date = $UDB1->Record["lr_date"];
        $dispatch_date = $UDB1->Record["dispatch_date"];
        $loading_end_date = $UDB1->Record["loading_end_date"];
        $invoice_no = $UDB1->Record["invoice_no"];
        $no_of_pack = $UDB1->Record["no_of_pack"];
        $weight = $UDB1->Record["weight"];
        $placement_date = $UDB1->Record["placement_date"];
        $placement_time = $UDB1->Record["placement_time"];
    }

    $unloading_date = "";
    $vehicle_release_date = "";
    $remarks = "";
    $damages = "";

    $Query1 = "SELECT unloading_date,vehicle_release_date,damages FROM sr_vehicle_reporting WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $unloading_date = $UDB1->Record["unloading_date"];
        $vehicle_release_date = $UDB1->Record["vehicle_release_date"];
        $damages = $UDB1->Record["damages"];
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


    $final_data .= '"' . $sno . '"' . "\t" . '"' . $order_no . '"' . "\t" . '"' . $vehicle_required_date . '"' . "\t" . '"' . $placement_date . '"' . "\t" . '"' . $loading_end_date . '"' . "\t" . '"' . $order_date . '"' . "\t" . '"' . $order_time . '"' . "\t" . '"' . $vehicle_required_date . '"' . "\t" . '"' . $vehicle_required_time . '"' . "\t" . '"' . $placement_date . '"' . "\t" . '"' . $placement_time . '"' . "\t" . '"' . $orgin . '"' . "\t" . '"' . $destination . '"' . "\t" . '"' . $vehicle_type . '"' . "\t" . '"' . $vehicle_no . '"' . "\t" . '"' . $weight . '"' . "\t" . '"' . $lr_no . '"' . "\t" . '" "' . "\t" . '" "' . "\t" . '"' . $escart_option . '"' . "\t" . '"' . $agreed_tat . '"' . "\t" . '"' . $actual_tat . '"' . "\t" . '"' . $hit_miss_status . '"' . "\t" . '"' . $delay_reason . '"' . "\t" . '"' . $driver_contact_no . '"' . "\n";
}
print "$final_data";
?>