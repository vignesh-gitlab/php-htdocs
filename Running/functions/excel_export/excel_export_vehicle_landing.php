<?php

require("../../template/common/header.config.php");
require("../../template/common/userdb_cofiguration.php");

$filename = "export.xls";
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
$header = '';
$data = '';

$select = "SELECT t1.id,t1.order_no,t1.client_name,t1.client_division,t1.client_branch,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t1.dispatch_date,t1.dispatch_time,t1.expected_dateof_delivery,t1.landing_date,t1.landing_time,t1.action_user,t2.lr_no from sr_vehicle_landing t1,sr_vehicle_dispatch t2 where t1.landing_status='Not Yet Unloaded' and t1.order_no=t2.order_no order by t1.order_no";

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

print "$header\n$data";
?>