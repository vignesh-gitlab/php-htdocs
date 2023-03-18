<?php

require("../../template/common/header.config.php");
require("../../template/common/userdb_cofiguration.php");
$tablename = "sr_customer_order";

ob_start();
session_start();
$user_database = $_SESSION['user_database'];

if (!mysql_connect(HOSTNAME, USERNAME, PASSWORD))
    die("Can't connect to database");
if (!mysql_select_db($user_database))
    die("Can't select database");

$sno = 1;
$line .= "S.No\tOrder No\tClient Name\tClient Division\tClient Branch\tOrgin\tDestination\tVehicle Type\tOrder Status\tOverall Status\n";
$data = "";

$Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,action_user from $tablename";
$UDB->query($Query);
while ($UDB->Multicoloums()) {

    $order_no = $UDB->Record["order_no"];
    $client_name = $UDB->Record["client_name"];
    $client_division = $UDB->Record["client_division"];
    $client_branch = $UDB->Record["client_branch"];
    $orgin = $UDB->Record["orgin"];
    $destination = $UDB->Record["destination"];
    $vehicle_type = $UDB->Record["vehicle_type"];

    $overall_status = "Order has Taken";
    $order_status = "Open";

    $Query1 = "select booking_status from sr_vehicle_booking where order_no='" . $order_no . "'";
    $result = mysql_query($Query1);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle has Booked";
            $order_status = "Open";
        }
    }

    $Query2 = "select placement_status from sr_vehicle_placement where order_no='" . $order_no . "'";
    $result = mysql_query($Query2);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle has Placed at Origin";
            $order_status = "Open";
        }
    }

    $Query3 = "select loading_status from sr_vehicle_loading_start where order_no='" . $order_no . "'";
    $result = mysql_query($Query3);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle Loading on Progress";
            $order_status = "Open";
        }
    }

    $Query4 = "select loading_status from sr_vehicle_loading_end where order_no='" . $order_no . "'";
    $result = mysql_query($Query4);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle Loading has Completed";
            $order_status = "Open";
        }
    }

    $Query5 = "select dispatch_status from sr_vehicle_dispatch where order_no='" . $order_no . "'";
    $result = mysql_query($Query5);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle Transit has Started";
            $order_status = "Open";
        }
    }

    $Query6 = "select landing_status from sr_vehicle_landing where order_no='" . $order_no . "'";
    $result = mysql_query($Query6);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle Unload has Started";
            $order_status = "Open";
        }
    }

    $Query7 = "select unloading_status from sr_vehicle_unloading where order_no='" . $order_no . "'";
    $result = mysql_query($Query7);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $overall_status = "Vehicle Unload has Completed";
            $order_status = "Open";
        }
    }

    $Query8 = "select reporting_status from sr_vehicle_reporting where order_no='" . $order_no . "'";
    $result = mysql_query($Query8);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $reporting_status = $rows["reporting_status"];
            if ($reporting_status == "Finalized") {
                $overall_status = "Order has Been Closed";
                $order_status = "Close";
            } else if ($reporting_status == "Reported") {
                $overall_status = "Vehicle has Been Released From Destination";
                $order_status = "Open";
            }
        }
    }

    $order_no = $UDB->Record["order_no"];
    $client_name = $UDB->Record["client_name"];
    $client_division = $UDB->Record["client_division"];
    $client_branch = $UDB->Record["client_branch"];
    $orgin = $UDB->Record["orgin"];
    $destination = $UDB->Record["destination"];
    $vehicle_type = $UDB->Record["vehicle_type"];

    $value = $sno . "\t" . $order_no . "\t" . $client_name . "\t" . $client_division . "\t" . $client_branch . "\t" . $orgin . "\t" . $destination . "\t" . $vehicle_type . "\t" . $order_status . "\t" . $overall_status . "\n";

    $line .= $value;
    $sno = $sno + 1;
}

$data .= trim($line) . "\n";

$filename = "Order Status Report.xls";

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");

session_cache_limiter("must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="' . $filename . '"');

print "$data";
?>