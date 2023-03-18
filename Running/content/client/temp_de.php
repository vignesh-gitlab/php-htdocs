<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_stationary';


$branch_code = $_REQUEST["branch_code"];
$book_type = $_REQUEST["book_type"];
if ($book_type == "Frieght Bill") {
    $Query = "SELECT max(cast(stationary_no as unsigned))as max_id,stationary_no,branch_code from sr_frieght_bill where branch_code='" . $branch_code . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $consignment_note_no = $UDB->Record["max_id"];
        $max_id = $UDB->Record["max_id"];
    }
    $new_max_id = $max_id + 1;
}

$str = $str . "\"" . $consignment_note_no . "\"" . ",";

if ($consignment_note_no == "") {
    $Query1 = "select max(id) as max_id from $tablename where branch_code='" . $branch_code . "' and book_type='" . $book_type . "'";
    $DB1->query($Query1);
    while ($DB1->Multicoloums()) {
        $large_id = $DB1->Record["max_id"];
    }
    $Query = "select from_no,to_no from $tablename where branch_code='" . $branch_code . "' and book_type='" . $book_type . "' and id='" . $large_id . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $from_to = $DB->Record["from_no"];
        $to_no = $DB->Record["to_no"];
        $str = $str . "\"" . $from_to . "\"" . ",";
        $str = $str . "\"" . "true" . "\"" . ",";
        $str = $str . "\"" . $consignment_note_no . "\"" . ",";
    }
} else {
    $Query = "select max(id) as max_id from $tablename where branch_code='" . $branch_code . "' and book_type='" . $book_type . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $large_id = $DB1->Record["max_id"];
    }
    $Query = "select from_no,to_no from $tablename where branch_code='" . $branch_code . "' and book_type='" . $book_type . "'  and id='" . $large_id . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $from_to = $DB->Record["from_no"];
        $to_no = $DB->Record["to_no"];
        if ($new_max_id >= $from_to && $new_max_id <= $to_no) {
            $str = $str . "\"" . $new_max_id . "\"" . ",";
            $str = $str . "\"" . "true" . "\"" . ",";
            $str = $str . "\"" . $consignment_note_no . "\"" . ",";
        } else if ($consignment_note_no == $to_no) {
            $str = $str . "\"" . $new_max_id . "\"" . ",";
            $str = $str . "\"" . "false" . "\"" . ",";
        }
        $str = $str . "\"" . $consignment_note_no . "\"" . ",";
    }
}
$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>