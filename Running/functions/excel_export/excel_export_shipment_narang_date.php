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

$condition = "client_name='Narang Danone Access Pvt.Ltd.'";
$from_date_val = explode("-", $_REQUEST["from_date"]);
$from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
$to_date_val = explode("-", $_REQUEST["to_date"]);
$to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0];
/* $from_date_val = explode("-", "01-06-2015");
  $from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
  $to_date_val = explode("-", "30-07-2015");
  $to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0]; */

$final_data .= 'S NO' . "\t" . '"ORDER NUMBER"' . "\t" . '"ORDER RECVD DT"' . "\t" . '"INDENT DATE"' . "\t" . '"PRIMARY/  SECONDARY"' . "\t" . '"VEHICLE PLACEMENT DT."' . "\t" . '"LOADING DATE"' . "\t" . '"ON /LATE TIME"' . "\t" . '"LR NO."' . "\t" . '"LORRY NO."' . "\t" . '"TYPE OF VEH."' . "\t" . '"FROM"' . "\t" . '"TO"' . "\t" . '"INVOICE NUMBER"' . "\t" . '"EDD"' . "\t" . '"REPORTED STATUS"' . "\t" . '"DELIVERED STATUS"' . "\t" . '"HIT/MISS."' . "\t" . '"DRIVER MOBILE NO."' . "\t" . '"REMARKS"' . "\n";
//$final_data ="";

$sno = 0;

$Query = "SELECT order_no,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_ownership_type,primary_secondary FROM sr_customer_order WHERE STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND " . $condition;
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
    $primary_secondary = $UDB->Record["primary_secondary"];

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

    $ontime_placement = "";
    $ontime_status = "";
    $Query1 = "SELECT ontime_placement FROM sr_vehicle_placement WHERE order_no='" . $order_no . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $ontime_placement = $UDB1->Record["ontime_placement"];
        if ($ontime_placement == "Yes") {
            $ontime_status = "On Time";
        } else {
            $ontime_status = "Late";
        }
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
    $delivery_note = "";

    $Query1 = "SELECT vehicle_no,weight,expected_dateof_delivery,lr_no,lr_date,dispatch_date,loading_end_date,invoice_no,no_of_pack,weight,placement_date,loading_start_date,placement_time,delivery_note FROM sr_vehicle_dispatch WHERE order_no='" . $order_no . "'";
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
        $delivery_note = $UDB1->Record["delivery_note"];
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

    $final_data .= '"' . $sno . '"' . "\t" . '"' . $order_no . '"' . "\t" . '"' . $order_date . '"' . "\t" . '"' . $vehicle_required_date . '"' . "\t" . '"' . $primary_secondary . '"' . "\t" . '"' . $placement_date . '"' . "\t" . '"' . $loading_end_date . '"' . "\t" . '"' . $ontime_status . '"' . "\t" . '"' . $lr_no . '"' . "\t" . '"' . $vehicle_no . '"' . "\t" . '"' . $vehicle_type . '"' . "\t" . '"' . $orgin . '"' . "\t" . '"' . $destination . '"' . "\t" . '"' . $invoice_no . '"' . "\t" . '"' . $expected_dateof_delivery . '"' . "\t" . '"' . $landing_date . '"' . "\t" . '"' . $landing_date . ' "' . "\t" . '"' . $hit_miss_status . '"' . "\t" . '"' . $driver_contact_no . '"' . "\t" . '"' . $delay_reason . ' "' . "\t" . '" "' . "\n";
}
print "$final_data";
?>