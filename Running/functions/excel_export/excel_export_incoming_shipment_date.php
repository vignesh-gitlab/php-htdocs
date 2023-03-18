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

$condition = $_REQUEST["condition"];
$from_date_val = explode("-", $_REQUEST["from_date"]);
$from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
$to_date_val = explode("-", $_REQUEST["to_date"]);
$to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0];

//$select = "SELECT * FROM sr_customer_order WHERE STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN '".$from_search_date."' AND '$to_search_date' AND order_status='Delivered' and destination like'E.I.DuPont India Private Limited%'";
$select = "SELECT * FROM sr_customer_order WHERE STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND " . $condition;

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