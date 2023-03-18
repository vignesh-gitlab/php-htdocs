<?php

require("../../template/common/header.config.php");
require("../../template/common/userdb_cofiguration.php");
$tablename = "sr_excel_export_report";

ob_start();
session_start();
$user_database = $_SESSION['user_database'];

if (!mysql_connect(HOSTNAME, USERNAME, PASSWORD))
    die("Can't connect to database");
if (!mysql_select_db($user_database))
    die("Can't select database");

$Query = "truncate table $tablename";
$UDB->query($Query);

$Query = "insert into $tablename values (NULL,'S.No','Order Number','Client Name','Client Division','Client Branch','Order Date','Order Date Export','Order Time','Shipment Date','Shipment Time','Origin','Destination','Type Of Vehicle','Arrival Date at Source','Arrival Time at Source','Ontime Status at Source','Vehicle Number','Transit Start Date','Transit Start Time','EDD','LR Number','Arrival Date at Destination','Arrival Time at Destination','Ontime Status at Destination','Total Transit Days','Hit / Miss/ Transit','Damages Remarks (If any)','Delay Remarks (If any)')";
$UDB->query($Query);

$sno = 1;

$from_date_val = explode("-", $_REQUEST["from_date"]);
$from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
$to_date_val = explode("-", $_REQUEST["to_date"]);
$to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0];

//$Query = "select order_no,client_name,client_division,client_branch,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type from sr_customer_order where client_name ='" . $_REQUEST["client_name"] . "'";
$Query = "select order_no,client_name,client_division,client_branch,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type from sr_customer_order where STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND client_name ='" . $_REQUEST["client_name"] . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {

    $order_no = $UDB->Record["order_no"];
    $client_name = $UDB->Record["client_name"];
    $client_division = $UDB->Record["client_division"];
    $client_branch = $UDB->Record["client_branch"];
    $order_date = $UDB->Record["order_date"];
    $order_time = $UDB->Record["order_time"];
    $vehicle_required_date = $UDB->Record["vehicle_required_date"];
    $vehicle_required_time = $UDB->Record["vehicle_required_time"];
    $orgin = $UDB->Record["orgin"];
    $destination = $UDB->Record["destination"];
    $vehicle_type = $UDB->Record["vehicle_type"];
    $order_date_val = explode("-", $order_date);
    $order_search_date = $order_date_val[2] . "-" . $order_date_val[1] . "-" . $order_date_val[0];


    $Query1 = "select placement_date,placement_time,ontime_placement,vehicle_no from sr_vehicle_placement where order_no='" . $order_no . "'";
    $result = mysql_query($Query1);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $placement_date = $rows["placement_date"];
            $placement_time = $rows["placement_time"];
            $ontime_placement = $rows["ontime_placement"];
            $vehicle_no = $rows["vehicle_no"];
        }
    } else {
        $placement_date = "";
        $placement_time = "";
        $ontime_placement = "";
        $vehicle_no = "";
    }

    $Query2 = "select dispatch_date,dispatch_time,expected_dateof_delivery,lr_no from sr_vehicle_dispatch where order_no='" . $order_no . "'";
    $result = mysql_query($Query2);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $dispatch_date = $rows["dispatch_date"];
            $dispatch_time = $rows["dispatch_time"];
            $expected_dateof_delivery = $rows["expected_dateof_delivery"];
            $lr_no = $rows["lr_no"];
        }
    } else {
        $dispatch_date = "";
        $dispatch_time = "";
        $expected_dateof_delivery = "";
        $lr_no = "";
    }

    $Query3 = "select order_no,landing_date,landing_time from sr_vehicle_landing where order_no='" . $order_no . "'";
    $result = mysql_query($Query3);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $landing_date = $rows["landing_date"];
            $landing_time = $rows["landing_time"];
            $close_status = $rows["order_no"];
        }
    } else {
        $landing_date = "";
        $landing_time = "";
        $close_status = "";
    }

    $Query4 = "select remarks from sr_vehicle_reporting where order_no='" . $order_no . "'";
    $result = mysql_query($Query4);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $remarks = $rows["remarks"];
        }
    } else {
        $remarks = "";
    }

    $Query5 = "select delay_reason from sr_vehicle_status where order_no='" . $order_no . "'";
    $result = mysql_query($Query5);
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) {
            $delay_reason = $rows["delay_reason"];
        }
    } else {
        $delay_reason = "";
    }

    //echo $expected_dateof_delivery."-".$landing_date."<br>";
    if (isset($close_status) && !empty($close_status)) {
        $datetime1 = new DateTime($expected_dateof_delivery);
        $datetime2 = new DateTime($landing_date);
        $interval = $datetime1->diff($datetime2);
        $ontime_landing_time = $interval->format('%R%d days');
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
        $total_transit = $interval->format('%d Days');
    } else {
        $hit_miss_status = "On Transit";
        $ontime_landing_status = "";
        $total_transit = "";
    }

    $Query6 = "insert into $tablename values (NULL,'" . $sno . "','" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $order_date . "','" . $order_search_date . "','" . $order_time . "','" . $vehicle_required_date . "','" . $vehicle_required_time . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $placement_date . "','" . $placement_time . "','" . $ontime_placement . "','" . $vehicle_no . "','" . $dispatch_date . "','" . $dispatch_time . "','" . $expected_dateof_delivery . "','" . $lr_no . "','" . $landing_date . "','" . $landing_time . "','" . $ontime_landing_status . "','" . $total_transit . "','" . $hit_miss_status . "','" . $remarks . "','" . $delay_reason . "')";
    mysql_query($Query6);
    $sno = $sno + 1;
}

$filename = "Performane Report.xls";

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

$header = '';
$data = '';


$select = "select s_no,order_no,client_name,client_division,client_branch,order_date,order_time,required_date,required_time,origin,destination,vehicle_type,placement_date,placement_time,ontime_placement,vehicle_number,dispatch_date,dispatch_time,expected_date_of_delivery,lr_number,landing_date,landing_time,ontime_landing,total_shipment_days,hit_miss,damage_remarks,delay_remarks from $tablename where id=1";
//$select = " select * from $tablename";

$export = mysql_query($select);
$fields = mysql_num_fields($export);


for ($i = 0; $i < $fields; $i++) {
    $header .= mysql_field_name($export, $i) . "\t";
}


while ($row = mysql_fetch_row($export)) {
    $line = '';
    foreach ($row as $value) {
        if ((!isset($value)) OR ( $value == "")) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line) . "\n";
}
$data = str_replace("\r", "", $data);
if ($data == "") {
    $data = "\n(0) Records Found!\n";
}



$select = "select s_no,order_no,client_name,client_division,client_branch,order_date,order_time,required_date,required_time,origin,destination,vehicle_type,placement_date,placement_time,ontime_placement,vehicle_number,dispatch_date,dispatch_time,expected_date_of_delivery,lr_number,landing_date,landing_time,ontime_landing,total_shipment_days,hit_miss,damage_remarks,delay_remarks from $tablename where order_date_export>='" . $from_search_date . "' and order_date_export<='" . $to_search_date . "'";
//$select = " select * from $tablename";

$export = mysql_query($select);
$fields = mysql_num_fields($export);


for ($i = 0; $i < $fields; $i++) {
    $header .= mysql_field_name($export, $i) . "\t";
}


while ($row = mysql_fetch_row($export)) {
    $line = '';
    foreach ($row as $value) {
        if ((!isset($value)) OR ( $value == "")) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line) . "\n";
}
$data = str_replace("\r", "", $data);
if ($data == "") {
    $data = "\n(0) Records Found!\n";
}

//print "$header\n$data";
print "$data";
?>