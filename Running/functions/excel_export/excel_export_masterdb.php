<?php

require("../../template/common/header.config.php");
require("../../template/common/userdb_cofiguration.php");

$filename = "export.xls";

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");

session_cache_limiter("must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="' . $filename . '"');

include '../../settings/config.db.php';
$db = new Database;


/* if (!mysql_connect(localhost, root, root))
  die("Can't connect to database");
  if (!mysql_select_db(srinfosoft_trackandtrace))
  die("Can't select database"); */

if (!mysql_connect(HOSTNAME, USERNAME, PASSWORD))
    die("Can't connect to database");
if (!mysql_select_db(DATABASE))
    die("Can't select database");

$tablename = $_GET["tablename"];
$header = '';
$data = '';

$select = "select * from $tablename";

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