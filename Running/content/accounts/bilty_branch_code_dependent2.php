<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_stationary';

$branch_code = $_REQUEST["branch_code"];
$book_type = $_REQUEST["book_type"];

$Query1 = "select max(id) as max_id from $tablename where branch_code='" . $branch_code . "' and book_type='" . $book_type . "'";
$DB1->query($Query1);
while ($DB1->Multicoloums()) {
    $large_id = $DB1->Record["max_id"];
}

$Query = "select from_no,to_no from $tablename where branch_code='" . $branch_code . "' and book_type='" . $book_type . "'  and id='" . $large_id . "'";
$DB->query($Query);
while ($DB->Multicoloums()) {
    $str = $str . "\"" . $DB->Record["from_no"] . "\"" . ",";
    $str = $str . "\"" . $DB->Record["to_no"] . "\"" . ",";
}

$str = substr($str, 0, (strLen($str) - 1)); // Removing the last char , from the string
echo "new Array($str)";
?>